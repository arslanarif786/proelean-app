<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Traits\FCMNotification;
use App\Http\Controllers\Api\Controller;
use App\Http\Resources\NotificationResource;
use App\Models\Notification;

class NotificationController extends Controller
{
    use FCMNotification;
    public function index()
    {
        $notifications = Notification::where('reciever_id', auth()->id())->latest()->simplePaginate(20);
        return NotificationResource::collection($notifications);
    }

    public function sendNotifications(Request $request)
    {
        $this->validateInput($request,[
            'reciever_id' => 'required|string|size:32',
            'subject' => 'required|min:3',
            'data' => 'required|array',
            'body' => 'required|string|min:2'
        ]);
        $result=$this->sendMessageNotification($request->reciever_id,$request->subject,$request->body,$request->data);
        return $result
        ? response()->json(['message'=> 'Notification sent successfully'])
        : response()->json(['message'=> 'Unable to send notification'],400);
    }

    public function delete($id)
    {
        return Notification::where('id', customDecrypt($id))->where('reciever_id', auth()->id())->firstOrFail()->delete()
        ? response()->json(['message' => 'Notification removed'],200)
        : response()->json(['message' => 'Request failed'],400);
    }
}
