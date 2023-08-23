<?php

namespace App\Http\Resources\Buyer;

use App\Http\Resources\User\UserResource;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class JobResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public static $wrap="data";
    public function toArray($request)
    {

        return [
            'id'=>customEncrypt($this->id),
            'user_id'=>customEncrypt($this->user_id),
            'category_id'=>customEncrypt($this->category_id),
            'sub_category_id'=>customEncrypt($this->sub_category_id),
            'description'=>$this->description,
            'slug' => $this->slug ?? '',
            'budget'=>(double)$this->budget,
            'delivery_time'=>$this->delivery_time,
            'cinic'=>isset($this->cinic) ? $this->cinic : '',
            'featured'=>isset($this->featured) ? (int)$this->featured : 0,
            'latitude'=>isset($this->lat) ? $this->lat : 0,
            'longitude'=>isset($this->lng) ? $this->lng : 0,
            'total_offers'=>isset($this->offers) ? (int)$this->offers : 0,
            'is_applied'=>isset($this->is_applied) ? $this->is_applied : 0,
            'created_at'=>date('d-M-Y h:i:A', strtotime($this->created_at)),
            'user'=>new UserResource($this->whenLoaded('user'))
        ];

    }
}
