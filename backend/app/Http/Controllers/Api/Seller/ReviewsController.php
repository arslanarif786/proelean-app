<?php

namespace App\Http\Controllers\Api\Seller;

use App\Http\Controllers\Api\Controller;
use App\Http\Resources\Seller\ReviewsResource;
use App\Models\Service;
use App\Models\ServiceReview;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReviewsController extends Controller
{
    public function serviceReviews()
    {
        //echo auth()->user()->id;die;
       $reviews= User::select('users.id','users.name','users.image','service_reviews.id as review_id','services.id','service_reviews.rating','service_reviews.description','service_reviews.id')
       ->join('service_reviews','users.id','service_reviews.user_id')
        ->join('services','services.id','service_reviews.service_id')
        ->where('services.user_id',auth()->user()->id)->latest('service_reviews.created_at')
        ->simplePaginate(10);
        $reviewsRating=ServiceReview::select('service_reviews.rating',DB::raw('AVG(service_reviews.rating) as ratings_average'),DB::raw('count(service_reviews.id) as total_reviews'))->join('services','services.id','service_reviews.service_id')->where('services.user_id',auth()->user()->id)->get();


        return response()->json([
            'avg_rating'=> round($reviewsRating[0]->ratings_average,1),
            'total_reviews'=>$reviewsRating[0]->total_reviews,
            'data'=>ReviewsResource::collection($reviews)
        ]);

    }
}
