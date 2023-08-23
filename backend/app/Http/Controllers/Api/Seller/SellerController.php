<?php
namespace App\Http\Controllers\Api\Seller;

use App\actions\Seller\SellerOrderAction;
use App\Http\Controllers\Api\Controller;
use App\Http\Requests\ExtendOrderDeliveryRequest;
use App\Http\Requests\Seller\ManageOrderRequest;
use App\Http\Resources\User\UserOrderResource;
use App\Models\ExtendOrderRequest;
use App\Models\Order;
use App\Services\Seller\SellerService;
use Illuminate\Support\Facades\DB;

class SellerController extends Controller
{
    public function manageOrders(ManageOrderRequest $request,SellerOrderAction $action)
    {
        return $action->handle((object)$request->validated());
    }

    public function getSellerReviews($id,SellerService $service)
    {
        return $service->returnSellerReviews(customDecrypt($id));
    }

    public function show()
    {
        $status=$_GET['status'] ?? null;
        $user=auth()->user();
        $userOrder=DB::table('orders')
            ->join("services","services.id","=","orders.service_id")
            ->join("users","users.id","=","orders.user_id")
            ->leftJoin('service_media', 'service_media.service_id', '=', 'services.id')
            ->where("services.user_id",$user->id)
            ->select('orders.*','services.rating as service_rating','services.user_id as seller_id','users.username','users.image', 'service_media.media as media')
            ->when( $status, function ($query) use ($status) {
              $query->where('orders.status_id',$status);
                    })
            ->groupBy('orders.id')->latest()->simplePaginate(20);

        return UserOrderResource::collection($userOrder);
    }

    public function extendOrderDeliveryDays(ExtendOrderDeliveryRequest $request)
    {
        $request = $request->validated();
        $order = Order::findOrFail(customDecrypt($request['order_id']));

        $extendOrderRequest = ExtendOrderRequest::create([
            'order_id' => $order->id,
            'seller_id' => auth()->id(),
            'extended_delivery_days' => $request['extended_delivery_days']
        ]);

        if($extendOrderRequest) {
            logactivity($order, auth()->user(), $request['description'], "EXTEND_ORDER", $request['extended_delivery_days'], "PENDING");
            return response()->json(['message'=>'Request sent successfully'],201);
        } else {
            return response()->json(['message'=>'Request failed'],400);
        }
    }
}
