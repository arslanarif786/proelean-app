<?php

namespace App\Services;

use App\Http\Resources\PaymentResource;
use App\Traits\StripeTrait;
use App\Models\{
    Course,
    Event,
    LiveStream,
    Payment,
    Post,
};

class PaymentService
{
    use StripeTrait;


    public function getPayments(string $type = "received")
    {
        $id = auth()->id();
        $u_columns = 'id,name';
        if ($type == 'received') {
            $attr = 'user_id';
        } else if ($type == 'paid') {
            $attr = 'payer_id';
        } else if (strlen($type) == 32) {
            $payment = Payment::with(["user:$u_columns","payer:$u_columns"])->findOrFail(idDecrypt($type));
            return new PaymentResource($payment);
        } else {
            return response()->json(['message' => 'invalid path'], 404);
        }

        $payments = Payment::with(["user:$u_columns","payer:$u_columns"])->where($attr, $id)->latest()->simplePaginate(10);
        return PaymentResource::collection($payments);
    }

    public function createStripeAccount()
    {
        $user = auth()->user();
        if (empty($user->stripe_account)) {
            $user->stripe_account = $this->createStripeExpressAccount();
            $user->save();
        }

        $link = $this->getStripeConnectAccountLink($user->stripe_account->id);
        return response()->json(['message' => 'Stripe Connect Account URL', 'data' => $link]);
    }

    public function createStripePaymentLink()
    {
        // $stripeAccount = $this->getStripeAccount();

        // $user =  auth()->user();
        // $user->stripe_account = $stripeAccount;
        // $user->save();

        // return $user->stripe_account;
        $request = request();
        $item = null;
        $userFields = 'id,name,stripe_account';

        if ($request->post_id) {
            $item = Post::with("user:$userFields")->findOrFail(idDecrypt($request->post_id));
        } else if ($request->course_id) {
            $item = Course::with("user:$userFields")->findOrFail(idDecrypt($request->course_id));
        } else if ($request->event_id) {
            $item = Event::with("user:$userFields")->findOrFail(idDecrypt($request->event_id));
        } else if ($request->livestream_id) {
            $item = LiveStream::with("user:$userFields")->findOrFail(idDecrypt($request->livestream_id));
        }
        //return $item->user->stripe_account;

        if (!$item) {
            return response()->json(['message' => 'either post/course/event/livestream id is required'], 422);
        } else if ($item->amount - $item->discount == 0) {
            return response()->json(['message' => 'This Post is free'], 422);
        } else if (!$item->user->canReceivePayments()) {
            return response()->json(['message' => 'Cannot Pay to this creator currently'], 422);
        }


        $link = $this->createCheckoutSession($item, $request->coupon ?? null);
        return response()->json(['message' => 'Stripe Connect Account URL', 'data' => $link->url]);
    }



    public function create($data)
    {
        $types = [
            'post' => Post::class,
            'event' => Event::class,
            'course' => Course::class,
            'payment' => Payment::class,
            'live_stream' => LiveStream::class
        ];

        $paybleType = $types[$data['product_type']];

        // Critical functionality is being performed in Payment Observer

        return Payment::create($data + ['payable_type' => $paybleType]);
    }


    public function update($id, $data = [])
    {
    }

    public function delete($id)
    {
    }
}
