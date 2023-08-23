<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class BankAccountResource extends JsonResource
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
            'id' => customEncrypt($this->id),
            'iban' => Str::mask($this->iban,'*',8,13),
            'bank_name' => $this->bank_name,
            'bank_title' => $this->bank_title,
        ];
    }
}
