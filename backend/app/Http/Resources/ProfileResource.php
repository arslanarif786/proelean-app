<?php

namespace App\Http\Resources;

use App\Http\Resources\Seller\ServiceResource;
use App\Http\Resources\User\UserDetailResource;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
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
            'name'=>isset($this->name) ? $this->name : "",
            'username'=>isset($this->username) ? $this->username : "",
            'image'=>isset($this->image) ? $this->image : "",
            'isFreelancer'=>isset($this->isFreelancer) ? $this->isFreelancer : 0,
            'created_at'=>isset($this->created_at) ? Carbon::parse($this->created_at)->toDateTimeString() : "",
            'address'=>isset($this->address) ? $this->address : "",
            'phone'=>isset($this->phone) ? $this->phone : "0",
            'email'=>isset($this->email) ? $this->email : "",
            'description'=>isset($this->description) ? $this->description : "",
            'total_reviews'=>$this->total_reviews ? $this->total_reviews : 0,
            'user_rating'=> (double) $this->user_rating ? $this->user_rating : 0,
            'recent_delivery'=>isset($this->recent_delivery) ? $this->recent_delivery : "yet not confirm what to return ?",
            'user_languages'=>$this->lang,
            'user_skills'=>isset($this->UserSkills) ? collect($this->UserSkills)->pluck('title') : [],
            'user_detail'=>new UserDetailResource($this->whenLoaded('Freelancer')),
            'services'=>ServiceResource::collection($this->whenLoaded('UserServices')),
            'active_orders'=>$this->active_orders,
            'monthly_selling'=>isset($this->monthly_earning) ? $this->monthly_earning : 0,
            'weekly_clicks'=>isset($this->weekly_clicks) ? $this->weekly_clicks : 0,
            'weekly_impression'=>isset($this->weekly_impression) ? $this->weekly_impression : 0,
            'analytics' => $this->analytics ?? [],
            'average_selling'=>$this->average_selling,
            'payments_enabled' => $this->arePaymentsEnabled(),
        ];
    }

    private function arePaymentsEnabled()
    {
        if (
            $this->stripe_account && $this->stripe_account->capabilities
            && isset($this->stripe_account->capabilities->transfers)
            && $this->stripe_account->capabilities->transfers == 'active'
        )
            return true;
        return false;
    }
}
