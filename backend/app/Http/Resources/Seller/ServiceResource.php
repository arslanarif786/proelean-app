<?php

namespace App\Http\Resources\Seller;

use App\Http\Controllers\Api\WishlistController;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\OtherServicesThatIOffer;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Seller\ServiceMediaResource;
use App\Http\Resources\Seller\ServiceReviewResource;
use App\Http\Resources\SubCategoryResource;
use App\Http\Resources\User\UserResource;
use App\Services\Seller\SellerService;

class ServiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public static $wrap = "data";
    public function toArray($request)
    {
        return [
            'id' => customEncrypt($this->id),
            's_description' => $this->s_description,
            'description' => $this->description,
            'slug' => $this->slug ?? '',
            'price' => isset($this->price) ? (float)$this->price : 0,
            'favourite' => isset($this->favourite) ? $this->favourite : 0,
            'revision' => !is_null($this->revision) ? (int)$this->revision : 0,
            'service_rating' => isset($this->rating) ? (float)$this->rating : 0,
            'total_orders' => !is_null($this->orders) ? (int)$this->orders : 0,
            'total_reviews' => isset($this->total_reviews) ? (int)$this->total_reviews : 0,
            'total_clicks' => isset($this->total_clicks) ? (int)$this->total_clicks : 0,
            'delivery_time' => isset($this->delivery_time) ? $this->delivery_time : "",
            'additional_info' => isset($this->additional_info) ? $this->additional_info : "",
            'lat' => $this->lat ?? 0.0,
            'lng' => $this->lng ?? 0.0,
            'category' => new CategoryResource($this->whenLoaded('category')),
            'sub_category' => new SubCategoryResource($this->whenLoaded('subCategory')),
            'service_user' => new UserResource($this->whenLoaded('UserService')),
            'service_media' => ServiceMediaResource::collection($this->ServiceMedia),
            'service_reviews' => ServiceReviewResource::collection($this->whenLoaded('ServiceReview')),
            'offered_services' => $this->includeOtherServicesIfRequestedFromWeb()
                ? OtherServicesThatIOffer::collection($this->includeOtherServicesIfRequestedFromWeb())
                : []
        ];
    }

    private function includeOtherServicesIfRequestedFromWeb()
    {
        $otherServices = [];
        if (($_GET['from'] ?? null) && $this->user_id != auth()->id()) {
            $otherServices = (new SellerService)->getService()->where('user_id', $this->user_id)->where('id', '!=', $this->id)->inRandomOrder()->limit(3)->get();
            $otherServices=(new WishlistController)->checkIfInWishlist($otherServices);
        }
        return $otherServices;
    }
}
