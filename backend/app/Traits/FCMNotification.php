<?php

namespace App\Traits;

use App\Models\FcmToken;
use App\Models\Notification;
use Http;

trait FCMNotification
{

    public function sendNotification($recieverID, $subject, $body, $contentID, $type = "ORDER")
    {
        $tokens = FcmToken::where('user_id', $recieverID)->pluck('fcm_token')->toArray();
        if (!$tokens) {
            return true;
        }

        $notification = [
            'title' => $subject,
            'body' => $body,
            'sound' => 'default',
            'badge' => '1',
            'icon' => request()->getSchemeAndHttpHost() . '/assets/images/logo.svg'
        ];

        $data = [
            'subject' => $subject,
            'body' => $body,
            'type' => $type,
            'contentID' => $contentID,
            // 'childID'=>$childID
        ];

        $arrayToSend = [
            'registration_ids' => $tokens,
            'notification' => $notification,
            'priority' => 'high',
            'sound' => 'default',
            'data' => $data
        ];

        return $this->sendFcmNotification($arrayToSend, $subject, $body, $type, $recieverID, $contentID);
    }


    public function sendMessageNotification($reciverID, $subject, $body, $data)
    {
        $recieverID = customDecrypt($reciverID);


        $tokens = FcmToken::where('user_id', $recieverID)->whereNotNull('fcm_token')->pluck('fcm_token')->toArray();
        if (!$tokens) {
            return true;
        };
        //echo $tokens[0];die;
        $notification = [
            'title' => $subject,
            'body' => $body,
            'priority' => 'high',
            'sound' => 'default',
            'badge' => '1',
            'icon' => request()->getSchemeAndHttpHost() . '/assets/images/logo.svg'
        ];

        $arrayToSend = [
            'registration_ids' =>$tokens,
            'notification' => $notification,
            'priority' => 'high',
            'sound' => 'default',
            'data' => $data
        ];


        return $this->sendFcmNotification($arrayToSend, $subject, $body, "MESSAGE", $recieverID, auth()->id());
    }

    private function sendFcmNotification($notification, string $subject, $body,string  $type, $recieverID, $contentID)
    {

        $serverKey = config('firebase.fcm_server_key');
        if (!$serverKey) {
            die('add fcm server key to .env');
        }

        $response = Http::withHeaders([
            'Authorization' => 'key=' .  $serverKey,
            'Content-Type' => 'application/json'
        ])->post('https://fcm.googleapis.com/fcm/send', $notification);
            //print_r($response->json());die;

        return $this->storeNotification(auth()->id(), $subject, $body, $type, $recieverID, $contentID) ? true : false;
    }


    // store notification to DB
    public function storeNotification($senderID, $subject, $body, $type, $recieverID, $contentID)
    {
        $isSaved=Notification::create([
            'reciever_id'=> (int) $recieverID,
            'subject'=>$subject,
            'body'=>$body,
            'type'=>$type,
            'sender_id'=>$senderID,
            'content_id' => $contentID
        ]);
        return $isSaved ? true : false;
    }
}
