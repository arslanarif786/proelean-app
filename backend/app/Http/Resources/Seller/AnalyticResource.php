<?php

namespace App\Http\Resources\Seller;

use Illuminate\Http\Resources\Json\JsonResource;

class AnalyticResource extends JsonResource
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
            'weekly_earning' => $this->weekly_earning,
            'year_earning'=> $this->year_earning,
            'monthly_earning'=> $this->monthly_earning,
            'total_earning'=> $this->total_earning,
            'current_balance'=> $this->current_balance,
            'active_orders'=> $this->active_orders,
            'payments_enabled' => $this->arePaymentsEnabled(),
            'analytics' => $this->analytics,
            'total_impressions' => $this->impressions,
            'total_clicks' => $this->clicks,
        ];
    }

    private function arePaymentsEnabled()
    {
        $user = auth()->user();
        if (
            $user->stripe_account && $user->stripe_account->capabilities
            && isset($user->stripe_account->capabilities->transfers)
            && $user->stripe_account->capabilities->transfers == 'active'
        )
            return true;
        return false;
    }
}
