<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubCategoryResource extends JsonResource
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
            'title'=>$this->title,
            'category_id'=>isset($this->category_id) ? customEncrypt($this->category_id) : 0,
            'banner'=>isset($this->banner) ? $this->banner : "",
            'slug' => $this->slug ?? '',
        ];
    }
}
