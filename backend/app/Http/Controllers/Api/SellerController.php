<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\BecomeSellerRequest;
use App\Http\Requests\Seller\SendOfferRequest;
use App\Http\Resources\Seller\ServiceReviewResource;
use App\Models\ServiceReview;
use App\Services\Seller\SellerService;
use Illuminate\Support\Facades\DB;


class SellerController extends Controller
{
    // BECOME FREELANCER
    public function store(BecomeSellerRequest $request,SellerService $service)
    {
        return $service->BecomeSeller($request->validated());
    }

    public function getBuyerRequests(SellerService $service)
    {
        return $service->getJobList();
    }

    public function sendOffer(SendOfferRequest $request,SellerService $service)
    {
        return $service->sendOfferToJob((object)$request->validated());
    }

    public function getServiceReviews($id)
    {
        $reviews = ServiceReview::select(['id','user_id','description','rating'])
            ->with("user:id,name,username,image")
            ->where('service_id',customDecrypt($id))->simplePaginate(10);

        return ServiceReviewResource::collection($reviews);
    }

    public function getAnalytics(SellerService $service)
    {
        return $service->analytics();
    }


    public function earningDetails(SellerService $service)
    {
        return $service->earningDetails();
    }

    public function cancelOffer($id)
    {
        $isSave = DB::table('cancel_offers')->insert([
            'job_id'=>customDecrypt($id),
            'user_id'=>auth()->id(),
            'created_at'=>now()->toDateTimeString(),
            'updated_at'=>now()->toDateTimeString()
        ]);
        return $isSave
        ? response()->json(['message'=>'Offer Removed Successfully..!'],200)
        : response()->json(['message'=>'Request failed'],400);
    }


}
