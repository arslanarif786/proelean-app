<?php

namespace App\Http\Controllers;

use App\Traits\StripeTrait;
use App\Models\User;
use App\Services\PaymentService;
use Log;

class StripeWebhookController extends Controller
{
    use StripeTrait;
    public function __invoke()
    {
        // Set your secret key. Remember to switch to your live secret key in production.
        // See your keys here: https://dashboard.stripe.com/apikeys
        \Stripe\Stripe::setApiKey(config('stripe.stripe_secret'));

        // If you are testing your webhook locally with the Stripe CLI you
        // can find the endpoint's secret by running `stripe listen`
        // Otherwise, find your endpoint's secret in your webhook settings in the Developer Dashboard
        $endpoint_secret = request()->route()->getName() == 'direct_stripe_webhook'
            ? config('stripe.webhook_signature')
            : config('stripe.connect_webhook_signature');

        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload,
                $sig_header,
                $endpoint_secret
            );
        } catch (\UnexpectedValueException $e) {
            Log::channel('payments')->error($e);
            // Invalid payload
            http_response_code(400);
            exit();
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            Log::channel('payments')->error($e);
            return response()->json(['Invalid payload'], 400);
            exit();
        }

        Log::channel('payments')->info("Webhook Event Type: " . $event->type);

        // Handle the event
        switch ($event->type) {

            case 'capability.updated':
                $capability = $event->data->object;
                Log::channel('payments')->info("capability.updated webhook response : " . $capability);
                $this->getAndUpdateStripeAccount($capability->account);
                break;

            case 'account.updated':
                $account = $event->data->object;
                Log::channel('payments')->info("account.updated webhook response received : " . $account);
                $this->getAndUpdateStripeAccount($account->id, $account);
                break;

            case 'account.application.authorized':
                $account = $event->data->object;
                Log::channel('payments')->info("account.application.authorized webhook response received : " . $account);
                $this->getAndUpdateStripeAccount($account->id);
                break;



            case 'payment_intent.succeeded':
                $paymentIntent = $event->data->object; // contains a \Stripe\PaymentIntent
                Log::channel('payments')->info("checkout.session.secceeded webhook response : " . $paymentIntent);
                //save payment to DB
                $payment = $this->savePayment($paymentIntent);
                if ($payment) {
                    Log::channel('payments')->info("Payment Saved/Recorded  Successfully :  " . $payment);
                }

                break;

            case 'checkout.session.completed':
                $paymentIntent = $event->data->object; // contains a \Stripe\PaymentIntent
                Log::channel('payments')->info("checkout.session.completed webhook response :  " . $paymentIntent);
                break;

            case 'payment_method.attached':
                $paymentMethod = $event->data->object; // contains a \Stripe\PaymentMethod
                Log::channel('payments')->info("payment_method.attached webhook response :  " . $paymentMethod);
                break;
                // ... handle other event types
            default:
                echo 'Unused event type ' . $event->type;
        }

        return response()->json(['Webhook Event Received Successfully']);
    }

    private function savePayment($paymentIntent)
    {
        $payment = (new PaymentService)->create([
            'user_id' => idDecrypt($paymentIntent->metadata->product_owner_id),
            'payer_id' => idDecrypt($paymentIntent->metadata->payer_id),
            'amount' => $paymentIntent->amount_received / 100,
            'service_fee' => $paymentIntent->metadata->stripe_fee,
            'app_fee' => $paymentIntent->metadata->app_fee,
            'vat' => $paymentIntent->metadata->vat,
            'payable_id' => idDecrypt($paymentIntent->metadata->product_id),
            'product_type' => $paymentIntent->metadata->product_type,
            'coupon' => $paymentIntent->metadata->coupon ?: null,
            'coupon_discount' => $paymentIntent->metadata->coupon_discount,
            'metadata' => $paymentIntent->metadata,
            'raw_response' => $paymentIntent,
            'receipt_url'=> $paymentIntent->charges->data[0]->receipt_url,
            'trx_id' => $paymentIntent->id,
        ]);

        return $payment;
    }

    private function getAndUpdateStripeAccount(string $stripeID, $stripeAccount = null)
    {
        $user =  User::whereJsonContains('stripe_account->id', $stripeID)->first();

        if ($user) {
            if (!$stripeAccount) {
                $stripeAccount = $this->getStripeAccount($stripeID);
            }

            if ($stripeAccount) {
                $user->update(['stripe_account' => $stripeAccount]);
                Log::channel('payments')->info("Stripe account updated in DB :  " . $stripeAccount);
            }
        }
    }
}
