<?php

namespace App\Http\Resources\User;

use App\Models\UserDetail;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class UserResource extends JsonResource
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
            'description' => $this->description ?? "",
            'image'=>isset($this->image) ? $this->image : "",
            'user_rating'=>isset($this->user_rating) ? (int)$this->user_rating : 0,
            'total_reviews'=>isset($this->total_reviews) ? (int)$this->total_reviews : 0,
            'created_at'=>isset($this->created_at) ? Carbon::parse($this->created_at)->toDateTimeString() : "",
            'country' => $this->appendCountryIfRequestFromWeb()
        ];
    }

    private function appendCountryIfRequestFromWeb()
    {
        $countryName='';
        if (($_GET['from'] ?? null)) {
            $country = UserDetail::join('countries', 'countries.id', '=', 'user_details.country_id')
                ->select('countries.name')
                ->where('user_id', $this->id)->first();

            $countryName = $country->name;
        }

        return $countryName;
    }
}
