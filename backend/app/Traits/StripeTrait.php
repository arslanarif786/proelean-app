<?php

namespace App\Traits;

use App\Models\OrderRefund;
use App\Models\User;
use Log;
use Str;
use Stripe;
use Exception;

trait  StripeTrait
{
    private $stripe;


    public function __construct()
    {
        $this->stripe = new \Stripe\StripeClient(
            config('stripe.stripe_secret')
        );
    }

    public function chargeAmount($price, $token, $service, $seller)
    {
        try {
            Stripe\Stripe::setApiKey(config('stripe.stripe_secret'));
            $charge = [
                "amount" => $price * 100,
                "currency" => 'eur',
                "source" => $token,
                "description" => 'Charge for service: ' . $service->title . "  Seller: " . $seller?->name,
            ];
            if ($seller?->email) {
                $charge['receipt_email'] = $seller?->email;
            }
            $success = Stripe\Charge::create($charge);
        } catch (Exception $e) {
            die(json_encode(['message' => $e->getMessage()], 400));
        }
        $success = json_decode(json_encode($success), true);
        return $success;
    }


    public function createCardToken($request)
    {
        $token = $this->stripe->tokens->create([
            'card' => [
                'number' => $request->number,
                'exp_month' => $request->exp_month,
                'exp_year' => $request->exp_year,
                'cvc' => $request->cvc,
            ],
        ]);

        return response()->json(['token' => $token->id]);
    }

    public function createStripeExpressAccount()
    {
        $user = auth()->user();

        $account = $this->stripe->accounts->create([
            'type' => 'express',
            'email' => $user->email,
            'metadata' => [
                'user_id' => customDecrypt($user->id),
                'user_name' => $user->user_name,
            ],
        ]);

        return $account;
    }


    public function getStripeConnectAccountLink(string $stripeID)
    {
        $host = $this->getDomainName(request()->getSchemeAndHttpHost());
        $link = $this->stripe->accountLinks->create([
            'account' => $stripeID,
            'refresh_url' => request()->getSchemeAndHttpHost() . '/api/v1/stripe-fail',
            'return_url' =>   $host . '/dashboard/payments',
            'type' => 'account_onboarding',
        ]);

        return $link;
    }

    private function getDomainName($url)
    {
        $url = str_replace('api.', '', $url);
        return $url;
    }

    public function getStripeAccount(int | string $id = 0)
    {
        if (is_numeric($id) && $id) {
            $stripeAccountID = User::findOrFail($id)->stripe_account?->id;
        } else if ($id === 0) {
            $stripeAccountID = auth()->user()->stripe_account?->id;
        } else if (!is_numeric($id)) {
            $stripeAccountID = $id;
        }

        if (!$stripeAccountID) {
            return false;
        }

        $account =  $this->stripe->accounts->retrieve($stripeAccountID, []);
        return $account;
    }

    public function refundAmount($orderID, $userID, $chargeID, $amount)
    {
        try {
            \Stripe\Stripe::setApiKey(config('stripe.stripe_secret'));
            $refund = \Stripe\Refund::create([
                'charge' => $chargeID,
                'amount' => $amount
            ]);
        } catch (Exception $e) {
            die(json_encode(['status' => 500, 'message' => $e->getMessage()]));
        }
        $refund = json_decode(json_encode($refund), true);
        $orderRefund = OrderRefund::create([
            'user_id' => $userID,
            'order_id' => $orderID,
            're_id' => $refund['id'],
            'object' => $refund['object'],
            'amount' => $refund['amount'],
            'currency' => $refund['currency'],
        ]);
        return $orderRefund;
    }

    public function payoutBalanceToConnectedAccount()
    {
        return $this->getStripeAccount(auth()->id());
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $user = auth()->user();

        $payout = \Stripe\Payout::create([
            'amount' => (int)$user->available_balance,
            'currency' => 'eur',
            // 'method' => 'instant',
        ], [
            'stripe_account' => $user->stripe_account->id,
        ]);
        return response()->json(['message' => 'Withdrawal initiated successfully', 'data' => $payout]);
    }

    public function createCheckoutSession($product, $couponCode = null)
    {
        $type = Str::singular($product->getTable());

        $desc = ucfirst($type) . " #" . $product->id;
        $stripeFee = (($product->amount * 0.29) + 0.03);
        $appFee = ($product->amount * 0.25) + (($product->amount * 0.25) * 0.25);
        $couponDiscount = 0;

        if ($couponCode) {
            foreach ($product->coupons as $coupon) {
                if ($coupon['coupon'] == $couponCode) {
                    $dateTime = date('Y-m-d H:i:s');
                    if ($coupon['valid_since'] > $dateTime && $coupon['valid_till'] <= $dateTime && $coupon['remaining_usages'] > 0) {
                        $couponDiscount =  $coupon['discount_type'] == "PERCENTAGE"
                            ?  (($product->amount - $product->discount) * $coupon['discount'] / 100)
                            : $product->discount;
                    }
                }
            }
        }

        $amount = $product->amount - $product->discount - $couponDiscount;



        $host = $this->getDomainName(request()->getSchemeAndHttpHost());

        $session = $this->stripe->checkout->sessions->create([
            'success_url' =>  $host . "/" . $this->getProductDetailRoute($type) . '/' . idEncrypt($product->id) . '?status=success',
            'cancel_url' =>  $host,
            'customer_email' => auth()->user()->email,
            'line_items' => [
                [
                    'amount' => $amount * 100,
                    'quantity' => 1,
                    'currency' => "eur",
                    'name' =>  $desc,

                ],
            ],
            'mode' => 'payment',
            'payment_intent_data' => [
                'application_fee_amount' => (int) (($stripeFee + $appFee) * 100),
                'receipt_email' => 'talhabhatti0257@gmail.com',
                'transfer_data' => [
                    'destination' =>  $product->user->stripe_account?->id,
                ],
                'metadata' => [
                    'product_id' => idEncrypt($product->id),
                    'product_type' => $type,
                    'product_owner_id' => idEncrypt($product->user->id),
                    'payer_id' => idEncrypt(auth()->id()),
                    'amount' => $amount,
                    'app_fee' =>  $appFee,
                    'stripe_fee' => $stripeFee,
                    'coupon' => $couponCode,
                    'coupon_discount' => $couponDiscount
                ],
            ],

        ]);

        return $session;
    }

    public function getPaymentDetails($paymentID)
    {
        $payment = $this->stripe->paymentIntents->retrieve($paymentID, []);
        return $payment;
    }

    public function getStripeBalance()
    {
        $stripeAccount = auth()->user()->stripe_account;
        if (!$stripeAccount) {
            return response()->json([
                'error' => 'You have not connected your Stripe account yet.'
            ], 400);
        }

        $balance = $this->stripe->balance->retrieve([], [
            'stripe_account' => $stripeAccount?->id,
        ]);
        return response()->json(['data' => $balance]);
    }
}
