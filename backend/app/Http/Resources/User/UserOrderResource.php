<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class UserOrderResource extends JsonResource
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
            'id'=>customEncrypt($this->id),
            'seller_id'=>isset($this->seller_id) ? customEncrypt($this->seller_id) : "",
            'buyer_id'=>isset($this->user_id) ? customEncrypt($this->user_id) : "",
            'disputed_by'=>isset($this->disputed_by) ? customEncrypt($this->disputed_by) : "",
            'image'=>$this->image,
            'media' => $this->media ?: "",
            'username'=>$this->username,
            'description'=>$this->description,
            'service_id'=>customEncrypt($this->service_id),
            'job_id'=>$this->job_id ? customEncrypt($this->job_id) : "",
            'amount'=>$this->amount,
            'service_rating'=>isset($this->service_rating) ? $this->service_rating : 0,
            'currency'=> isset($this->type) && $this->type == 'eur' ? '€' : '$',
            'orderNo'=>$this->orderNo,
            'is_rated'=>$this->is_rated,
            'type'=>$this->type,
            'status_id'=>$this->status_id,
            'watch'=>$this->watch ? $this->watch : "",
            'notes'=>$this->notes ? $this->notes : "",
            'started'=>$this->started,
            'created_at'=>$this->created_at,
            'end_date'=>isset($this->end_date) ? Carbon::parse($this->end_date)->toDateTimeString() : $this->created_at,
            'delivery_time'=>is_null($this->delivery_time) ? "Null" : $this->delivery_time,
            'delivery_note'=>$this->delivery_note ? $this->delivery_note : "",
            'delivered_file'=>$this->delivered_file ? $this->delivered_file : "",
            'revision'=>$this->revision ? $this->revision : 0
        ];
    }
}
