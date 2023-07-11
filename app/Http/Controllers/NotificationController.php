<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\MessageReceived;
use App\Models\Message;
use Illuminate\Support\Facades\Mail;

class NotificationController extends Controller
{
    //
    public function save_message($body,?int $user_id, ?int $sender_id, ?string $phone, $type=1, $send_status=0)
    {
        $message = new Message();
        $message->body = $body;
        $message->user_id = $user_id;
        $message->sender_id = $sender_id;
        $message->phone = $phone;
        $message->type = $type;
        $message->send_status = "0";
        $message->save();

        return $message;
        
    }
 
    

    public function sendSms($phone, $sms){
        
    }
}
