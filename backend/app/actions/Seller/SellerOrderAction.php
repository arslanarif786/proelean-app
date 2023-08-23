<?php
namespace App\actions\Seller;

use App\Models\{Order, Payment, User};
use App\Traits\{FCMNotification,MediaTrait, StripeTrait};
use App\Jobs\SendEmailJob;

class SellerOrderAction{
    use MediaTrait,FCMNotification, StripeTrait;
    public function handle($request)
    {
        $user=auth()->user();
        $order=Order::where('id', customDecrypt($request->order_no))->orWhere('orderNo',$request->order_no)->firstOrFail();

        $buyer=User::find($order->user_id);

        switch($request->type){
            case 5:
                $order->dispute = [
                    'by' => $order->seller_id,
                    'to' => $order->buyer_id,
                    'reason' => $request->reason ?? null
                ];
                $isUpdate=$order->update(['pre_status'=>$order->status_id,'disputed_by'=>$user->id,'status_id'=>5, 'dispute' => $order->dispute]);
                $user->decrement('active_orders');
                $type='Disputed';
                $body="$user->name marked your order as disputed";
                $order_status=[
                    'status'=>5,
                    'disputed_by'=>$user->id
                ];
            break;

            case 2:
                $type=request()->file('delivered_file')->getClientOriginalExtension();
                $name=rand(999,9999).time().rand(1,9). ".". $type;
                $file=request()->file('delivered_file')->move(public_path('uploads/deliveredfile'), $name);
                $isUpdate=$order->update([
                    'delivery_note'=>$request->delivery_note,
                    'delivered_file'=>'uploads/deliveredfile/'.$name,
                    'pre_status'=>$order->status_id,
                    'status_id'=>2
                ]);
                $type='Delivered';
                $body="$user->name marked your order as delivered";
                $order_status=['status'=>2];
            break;

            case 6:
                $isUpdate=$order->update(['pre_status'=>$order->status_id,'status_id'=>6]);
                $user->decrement('active_orders');
                $type='Cancelled';
                $body="$user->name wants to cancel the order #$order->orderNo";
                $order_status=['status'=>6];
            break;

            // for cancel own dispute request
            case 8:
                if(!$order->dispute || $order->dispute->by != $user->id) {
                    return response()->json(['message' => 'No dispute request exist']);
                }
                $order->dispute = [];
                $order->status_id = $order->pre_status;
                $order->save();
                $user->increment('active_orders');                
                $body = "$user->name cancel disputed on order";
                logactivity($order, $user, $body, "ORDER");
                return !$order->dispute
                ? response()->json(['message'=>'Request Removed Successfully'],200)
                : response()->json(['message'=>'Oops internal server error..'],400);
            break;

            // for agree on dispute request
            case 9:
                // check if dispute request exist
                if (!$order->dispute && $order->dispute->by != $user->id) {
                    return response()->json(['message' => 'No Dispute Exist..'], 400);
                }
                $payment=Payment::where('order_id', $order->id)->first();
                $refund=$this->refundAmount($order->id,$user->id,$payment->txn_id,$payment->amount);
                $isUpdate=$order->update(['pre_status'=>$order->status_id,'status_id'=>6]);
                return $refund
                ? response()->json(['message'=>'Your Application Has Been Recieved, you will notify shortly'],200)
                : response()->json(['message'=>'Oops internal server error please try later'],400);
            break;

            default:
                die(json_encode(['message'=>'invalid command..']));
        }
        if(isset($order_status))
        {
            logactivity($order,$user,$body, "ORDER", $type);

            $this->sendNotification($order->user_id,$user->name,$body,$order->id, "ORDER");

            dispatch(new SendEmailJob([
                'seller_name'=>$user->name,
                'order_no'=>$order->orderNo,
                'end_date'=>$order->end_date,
                'buyer_name'=>$buyer->name,
                'buyer_email'=>$buyer->email,
                'mailTo'=>'buyer',
                'mailFor'=>'manage_order'
                ]+$order_status));
        }


        return isset($isUpdate) && $isUpdate
        ? response()->json(['message'=>'Order '.$type.' Successfully..'],200)
        : response()->json(['message'=>'Oops Internal Server Error..'],400);
    }
}
