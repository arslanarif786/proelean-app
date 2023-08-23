<?php

namespace App\Http\Resources;

use App\Http\Resources\Seller\ServiceResource;
use App\Http\Resources\AdsResource;
use App\Http\Resources\LanguageResource;
use App\Http\Resources\CountryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class HomeResource extends JsonResource
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
        // return parent::toArray($request);
        return [
            'countries' => isset($this->countries) ? CountryResource::collection($this->countries) : [],
            'categories'=> CategoryResource::collection($this->categories),
            'featGigs'=> isset($this->featGigs) ? ServiceResource::collection($this->featGigs) : [],
            'ads'=> isset($this->ads) ? AdsResource::collection($this->ads) : [],
            'languages'=>isset($this->languages) ? $this->languages->pluck('language')->toArray() : [],
            'delivery_days'=>isset($this->delivery_days) ? $this->delivery_days->pluck('days')->toArray() : [],
            'revisions'=>isset($this->revisions) ? $this->revisions->pluck('revision_count')->toArray() : []
        ];
    }
}
