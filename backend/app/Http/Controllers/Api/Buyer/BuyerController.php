<?php

namespace App\Http\Controllers\Api\Buyer;

use App\actions\Buyer\BuyerOrderAction;
use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Buyer\ChatOrderRequest;
use App\Http\Requests\Buyer\JobOfferOrderRequest;
use App\Http\Requests\Buyer\OrderStoreRequest;
use App\Http\Requests\Buyer\ManageOrderRequest;
use App\Http\Requests\Buyer\ExtendOrderDeliveryRequest;
use App\Http\Resources\Buyer\JobOfferResource;
use App\Http\Resources\User\UserOrderResource;
use App\Models\ExtendOrderRequest;
use App\Models\Job;
use App\Models\Service;
use App\Models\JobOffer;
use App\Models\Order;
use App\Services\Buyer\PlaceOrderService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Spatie\Activitylog\Models\Activity;

class BuyerController extends Controller
{
    public function show()
    {
        $status = $_GET['status'] ?? null;
        $userOrder = DB::table('orders')
            ->join("services", "services.id", "=", "orders.service_id")
            ->join("users", "users.id", "=", "services.user_id")
            ->leftJoin('service_media', 'service_media.service_id', '=', 'services.id')
            ->select('orders.*', 'users.id as seller_id', 'users.username', 'users.image', 'service_media.media as media')
            ->where("orders.user_id", auth()->id())
            ->when($status, function ($query) use ($status) {
                $query->where('orders.status_id', $status);
            })
            ->groupBy('orders.id')
            ->latest()->simplePaginate(10);

        return UserOrderResource::collection($userOrder);
    }

    // DELETE USER REQUEST FOR JOB
    public function destroy($id)
    {
        $id = customDecrypt($id);

        $offer = JobOffer::findOrFail($id);
        if ($offer) {
            Job::find($offer->job_id)->decrement('offers');
        }
        return $offer->delete()
            ? response()->json(['message' => 'Request Removed Successfully..!'], 200)
            : response()->json(['message' => 'Request failed'], 400);
    }

    public function customOrder(OrderStoreRequest $request, PlaceOrderService $placeOrder)
    {
        $service = Service::findOrFail(customDecrypt($request->service_id))->only(['price', 'delivery_time', 'revision']);
        $data = collect($request->validated())->merge($service);
        return $placeOrder->purchaseGig($data);
    }

    public function storeChatOrder(ChatOrderRequest $request, PlaceOrderService $placeOrder)
    {
        return $placeOrder->purchaseGig($request->validated());
    }

    public function jobOfferOrder(JobOfferOrderRequest $request, PlaceOrderService $placeOrder)
    {
        $orderDetails = JobOffer::select(['id', 'job_id', 'service_id', 'price', 'delivery_time'])
            ->with(["job:id,description", "Service" => function ($q) {
                return $q->where('status', 0)->select(['id', 'revision', 'status']);
            }])->findOrFail(customDecrypt($request->offer_id));

        if(!isset($orderDetails->Service))
            return response()->json(['message' => 'Service is deleted by owner unable to proceed']);

        $data = collect($request->only('token'))->merge(collect($orderDetails)->except(['job', 'Service']));
        $data['description'] = $orderDetails->job->description;
        $data['revision'] = $orderDetails->Service->revision;
        return $placeOrder->purchaseGig($data, $data['job_id']);
    }

    public function manageOrder(ManageOrderRequest $request, BuyerOrderAction $action)
    {
        return $action->handle((object)$request->validated());
    }

    public function getJobOffers($id)
    {
        $jobOffer = JobOffer::with("user")->where('job_id', customDecrypt($id))->where('status', 1)->simplePaginate(12);
        return JobOfferResource::collection($jobOffer);
    }


    public function handleOrderExtendTimeRequest(ExtendOrderDeliveryRequest $request)
    {
        $orderID = customDecrypt($request->order_id);
        $extendOrderRequest = ExtendOrderRequest::where('order_id', $orderID)->firstOrFail();

        if ($extendOrderRequest) {

            $order = Order::findOrFail($orderID);

            if ($request->accept == "ACCEPTED") {
                $days = (int)ltrim($extendOrderRequest->extended_delivery_days, 'A..z: ');
                $order->end_date = Carbon::parse($order->end_date)->addDays($days);
                $order->save();
            }

            $extendOrderRequest->update([
                'accepted' => $request->accept
            ]);

            $log = Activity::where("log_name",$order->orderNo)->firstOrFail();

            if($log) {
                $log->properties->action = $request->accept;
                $log->save();
            }

            $extendOrderRequest->delete();

            return $request->accept == "ACCEPTED"
                ? response()->json(['message' => 'Request accepted!'])
                : response()->json(['message' => 'Request cancelled!']);
        } else {
            return response()->json(['message' => 'Request failed!'], 400);
        }
    }
}
