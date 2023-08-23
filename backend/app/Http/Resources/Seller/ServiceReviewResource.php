<?php

namespace App\Http\Resources\Seller;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User\UserResource;

class ServiceReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>customEncrypt($this->id),
            'rating'=>isset($this->rating) ? $this->rating: 0,
            'description'=>$this->description,
            'user'=>isset($this->user) ? new UserResource($this->user) : []
        ];
    }
}
