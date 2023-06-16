<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        $address = 'developer@ludovickonyo.com';
        $subject = $this->data['subject'];
        $to = $this->data['to'];

        return $this->view('mail.test')
            ->from($address,'NIT STUDENT COMPLAINT SYSTEM')
            ->to($to)
            ->subject($subject)
            ->with(['test_message' => $this->data['message'],'subject' => $this->data['subject'],'name'=>$this->data['name']]);
    }
}