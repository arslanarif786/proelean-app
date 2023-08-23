<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use App\Http\Resources\OrderLogResource;
use App\Http\Resources\User\UserOrderResource;
use App\Models\Order;
use App\Models\Service;
use Spatie\Activitylog\Models\Activity;

class OrderController extends Controller
{
    public function index($id)
    {
        $user=auth()->user();
        $order=Order::findOrFail(customDecrypt($id));
        $seller=Service::findOrFail($order->service_id)->UserService;

        $order->seller_id=$seller->id;
        if($order->user_id==$user->id){
            $order->username=$seller->username;
            $order->image=$seller->image;
        } else{
            $order->username=$user->username;
            $order->image=$user->image;
        }

        return new UserOrderResource($order);
    }
    // USER ORDER TIMELINE
    public function getTimeline($id)
    {
        $orderActivity=Activity::select('description', 'properties', 'causer_id', 'created_at')
            ->where('log_name',$id)
            ->latest()->simplePaginate(10);
        return OrderLogResource::collection($orderActivity);
    }
}
