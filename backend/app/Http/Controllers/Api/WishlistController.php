<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use App\Http\Resources\Seller\ServiceResource;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Services\Seller\SellerService;

class WishlistController extends Controller
{
    public function index()
    {
        $getServiceIds=Wishlist::where('user_id',auth()->id())->pluck('service_id')->toArray();
        $services=(new SellerService)->getService()
            ->whereIn('id',$getServiceIds)
            ->groupBy('services.id')->simplePaginate(20);
        for($i = 0; $i < sizeof($services); $i++) {
            $services[$i]->favourite = 1;
        }
        return ServiceResource::collection($services);
    }
    //  user wishlist
    public function wishlist(Request $request)
    {
        $user=auth()->user();
        $exist=Wishlist::where('service_id',customDecrypt($request->service_id))
            ->where('user_id',$user->id)->first();
        if($exist){
            return $exist->delete()
            ? response()->json(['message'=>'Unfavourite Successfully..!'],200)
            : response()->json(['message'=>'Request failed'],400);
        }
        $wishlist=Wishlist::create($request->only('service_id')+['user_id'=>$user->id]);
        return $wishlist
        ? response()->json(['message'=>'Favourite Successfully..!'],200)
        : response()->json(['message'=>'Request failed'],400);
    }

    // CHECK WISHLIST
    public function checkIfInWishlist($services)
    {
        if (!isset($services[0]->id) && $services->isEmpty()){
            return $services;
        }
        
        $userID = auth()->id() ?? null;

        foreach ($services as $service) {
            $serviceIds[] = $service->id;
        }

        if (!empty($serviceIds)) {
            $wishlist = Wishlist::where('user_id', $userID)->orWhere('device_id', $this->getDeviceId())
                ->whereIn('service_id', $serviceIds)->pluck('service_id')->toArray();

            if (!empty($wishlist)) {
                foreach ($services as $service) {
                    $service->favourite=0;
                    if (in_array($service->id, $wishlist)) {
                        $service->favourite = 1;
                    }
                }
            }
        }

        return $services;
    }

}
