<?php

namespace App\Services\Buyer;

use App\Jobs\SendEmailJob;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Service;
use App\Models\Setting;
use App\Traits\FCMNotification;
use App\Traits\StripeTrait;

/**
 * Class PlaceOrder
 * @package App\Services
 */
class PlaceOrderService
{
    use FCMNotification, StripeTrait;

    public function purchaseGig($request, $jobID = null)
    {
        $user = auth()->user();
        $serviceID = customDecrypt($request['service_id']);
        $service = Service::findOrFail($serviceID);
        $seller =  $service->seller;

        $payment = $this->chargeAmount($request['price'], $request['token'], $service, $seller);
        $order = $this->storeOrder(1, $user->id, $seller->id, $serviceID, $request['delivery_time'], $jobID, $request['description'], $request['price'], $payment['id'], $payment['currency'], 'custom', $request['revision']);
        $payment = $this->savePayment($payment, $order, $service->price);

        $seller->increment('active_orders');
        logactivity($order, $user, 'Order Started');
        $this->sendNotification($seller->id, auth()->user()->name, "Great News: You've received an order from $user->name", $order->id, "ORDER");
        dispatch(new SendEmailJob([
            'seller_email' => $seller->email,
            'seller_name' => $seller->name,
            'order_no' => $order->orderNo,
            'end_date' => $order->end_date,
            'buyer_name' => $user->name,
            'mailFor' => 'neworder',
            'mailTo' => 'seller'
        ]));
        return $payment && $order
            ? response()->json(['message' => 'Order Placed Successfully...'], 201)
            : response()->json(['message' => 'Internal Server Error Please Try Later...'], 400);
    }

    private function savePayment($payment, $order, $serviceAmount)
    {
        $setting = Setting::first();

        $stripeFee = (($serviceAmount * 0.029) + 0.3);
        $appFee = $serviceAmount * ( (float) $setting->app_fee / 100);
        $vat = $appFee * ( (float) $setting->vat / 100);
        $deduction = $stripeFee + $appFee + $vat;
        $balance =  $serviceAmount - $deduction;
        return Payment::create([
            'user_id' => auth()->id(),
            'order_id' => $order->id,
            'txn_id' => $payment['id'],
            'currency' => $payment['currency'],
            'brand' => $payment['source']['brand'],
            'reciept_url' => $payment['receipt_url'],
            'amount' => $order->amount,
            'raw_response' => $payment,
            'seller_share' => $balance,
            'deduction' => $deduction
        ]);
    }
    private function storeOrder($orderStatus, $userID, $seller_id, $serviceID, $delivery_time, $jobID, $jobDescription, $servicePrice, $paymentCurrency, $type = 'normal', $revision = null)
    {
        $orderNo = rand(999, 9999) . $userID . time() . rand(1, 9);
        $order = Order::create([
            'user_id' => $userID,
            'seller_id' => $seller_id,
            'service_id' => $serviceID,
            'job_id' => $jobID,
            'amount' => $servicePrice,
            'status' => $orderStatus,
            'pre_status' => $orderStatus,
            'orderNo' => (string)$orderNo,
            'type' => $type,
            'revision' => $revision,
            'delivery_time' => $delivery_time,
            'status_id' => $orderStatus,
            'description' => $jobDescription,
            'currency' => $paymentCurrency,
        ]);
        return $order;
    }
}
