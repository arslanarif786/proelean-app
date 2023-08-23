<?php

namespace App\Http\Resources\Buyer;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User\UserResource;

class JobOfferResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // parent::toArray($request)
        return [
            'id'=>customEncrypt($this->id),
            'description'=>$this->description,
            'delivery_time'=>$this->delivery_time,
            'price'=>$this->price,
            'profile'=> new UserResource($this->whenLoaded('user')),
        ];
    }
}
