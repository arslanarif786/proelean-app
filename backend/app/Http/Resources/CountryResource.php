<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'id'=>customEncrypt($this->id),
            'name'=>$this->name,
            'image'=>''.'assets/images/flags/'.strtolower($this->iso2).'.png',
            'phonecode'=>$this->phonecode
        ];
    }
}
