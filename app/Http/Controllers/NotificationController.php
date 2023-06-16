<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\MessageReceived;
use App\Models\Messages;
use Illuminate\Support\Facades\Mail;

class NotificationController extends Controller
{
    //
    public function submit(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        $message = new Messages;
        $message->name = $request->name;
        $message->email = $request->email;
        $message->message = $request->message;
        $message->save();

        Mail::to('developer@ludovickonyo.com')->send(new MessageReceived($message));


        return back()->with('successMessage', 'Your message has been sent successfully!');
    }

    public function sendSms($phone, $sms){
        
    }
}
