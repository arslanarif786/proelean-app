<?php

namespace App\actions\Buyer;

use App\Jobs\SendEmailJob;
use App\Models\{Order, Payment, Service, ServiceReview};
use App\Services\Seller\SellerService;
use App\Traits\{FCMNotification, StripeTrait};

class BuyerOrderAction
{
    use FCMNotification, StripeTrait;
    public function handle($request)
    {
        $user = auth()->user();
        $order = Order::where('id', customDecrypt($request->order_no))->orWhere('orderNo', $request->order_no)->firstOrFail();
        $service = Service::find($order->service_id);
        $seller = $service->seller;
        $type = '';
        $SellerService = new SellerService;

        switch ($request->type) {
            case 3:
                if ((int)$order->revision > 0) {
                    $isUpdate = $order->update(['pre_status' => $order->status_id, 'status_id' => 3, 'revision_descripton' => $request->revision_description]);
                    $order->decrement('revision', 1);
                    $type = 'Revision';
                    $body = "$user->name assigned revision on your delivery. '$request->revision_description'";
                    $order_status = ['status' => 3];
                } else {
                    die(json_encode(['message' => 'Insuficient Revision To Perform This Action']));
                }
                break;

            case 4:
                $payment = Payment::where('order_id', $order->id)->firstOrFail();
                $seller->available_balance +=  $payment->seller_share;
                $seller->active_orders -= 1;
                $seller->save();

                $isUpdate = $order->update(['pre_status' => $order->status_id, 'status_id' => 4]);
                
                $type = 'Completed';
                $body = "$user->name marked your order as completed";
                $order_status = ['status' => 4];
                break;

            case 5:
                $order->dispute = [
                    'by' => $order->user_id,
                    'to' => $order->seller_id,
                    'reason' => $request->reason ?? null
                ];

                $isUpdate = $order->update(['pre_status' => $order->status_id, 'disputed_by' => $user->id, 'status_id' => 5, 'dispute' => $order->dispute]);
                $type = 'Disputed';
                $body = "$user->name disputed on order";
                $seller->decrement('active_orders');
                $order_status = ['status' => 5];
                break;

                // for cancel own dispute request
            case 8:
                if(!$order->dispute || $order->dispute->by != $user->id) {
                    return response()->json(['message' => 'No dispute request exist']);
                }
                $order->dispute = [];
                $order->status_id = $order->pre_status;
                $order->save();
                $seller->increment('active_orders'); 
                $body = "$user->name cancel disputed on order";
                logactivity($order, $user, $body, "ORDER");
                return !$order->dispute
                    ? response()->json(['message' => 'Request Removed Successfully'], 200)
                    : response()->json(['message' => 'Oops internal server error..'], 400);
                break;

                // for agree on dispute request
            case 9:             
                if (!$order->dispute && $order->dispute->by != $user->id) {
                    return response()->json(['message' => 'No Dispute Exist..'], 400);
                }
                $payment = Payment::where('order_id', $order->id)->first();
                // make refund
                $refund = $this->refundAmount($order->id, $user->id, $payment->txn_id, $payment->amount);
                $isUpdate = $order->update(['pre_status' => $order->status_id, 'status_id' => 6]);
                $seller->decrement('active_orders');
                return $refund
                    ? response()->json(['message' => 'Your Application Has Been Recieved, you will notify shortly'], 200)
                    : response()->json(['message' => 'Oops internal server error please try later'], 400);
                break;

                // for reviews
            case 10:
                $saveReview = ServiceReview::create([
                    'user_id' => $user->id,
                    'description' => $request->description,
                    'service_id' => $service->id,
                    'rating' => $request->rating
                ]);
                if ($saveReview) {
                    $serviceIds = $seller->Services->pluck('id')->toArray();
                    $serviceTotalRating = $SellerService->getServiceAvgRating($service->id);
                    $userTotalRating = $SellerService->getUserAvgRating($serviceIds);
                    $order->update(['is_rated' => 1]);
                    $service->update([
                        'rating' => (int)$serviceTotalRating['rating'],
                        'total_reviews' => (int)$serviceTotalRating['reviews']
                    ]);
                    $seller->update([
                        'user_rating' => (int)$userTotalRating['rating'],
                        'total_reviews' => (int)$userTotalRating['reviews']
                    ]);
                    return response()->json(['message' => 'Review added successfully..'], 201);
                }
                return response()->json(['message' => 'Oops internal server error..'], 400);
                break;

            default:
                die(json_encode(['message' => 'invalid command..']));
        }
        // notify seller
        if (isset($order_status)) {
            logactivity($order, $user, $body, "ORDER", $type);
            $this->sendNotification($seller->id, $user->name, $body, $order->id, "ORDER");
            dispatch(new SendEmailJob([
                'seller_email' => $seller->email,
                'seller_name' => $seller->name,
                'order_no' => $order->orderNo,
                'end_date' => $order->end_date,
                'buyer_name' => $user->name,
                'mailTo' => 'seller',
                'mailFor' => 'manage_order',
            ] + $order_status));
        }
        return isset($isUpdate) && $isUpdate && $type
            ? response()->json(['message' => 'Order marked ' . $type . ' Successfully..'], 200)
            : response()->json(['message' => 'Oops Internal Server Error..'], 400);
    }
}
