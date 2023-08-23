<?php

namespace App\Http\Resources\Seller;

use Illuminate\Http\Resources\Json\JsonResource;

class ReviewsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>customEncrypt($this->review_id),
            'user_name'=>$this->name,
            'rating'=>$this->rating,
            'profile'=>$this->image,
            'comment'=>$this->description,
        ];
    }
}
