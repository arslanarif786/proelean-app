<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
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
            'id' => customEncrypt($this->id),
            'sender_id' => customEncrypt($this->sender_id),
            'sender_pic' => $this->sender_pic ? $this->sender_pic : '',
            'reciever_id' => customEncrypt($this->reciever_id),
            'body' => $this->body,
            'name' => $this->subject,
            'type' => $this->type,
            'content_id' => $this->content_id ? customEncrypt($this->content_id) : 0,
            'created_at' => $this->created_at
        ];
    }
}
