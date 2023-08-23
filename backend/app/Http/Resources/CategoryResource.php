<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'id'=>customEncrypt($this->id),
            'title'=>$this->title,
            'slug' => $this->slug ?? '',
            'banner'=>isset($this->banner) ? $this->banner : '',
            'description'=>isset($this->description) ? $this->description : '',
        ];
    }
}
