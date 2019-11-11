<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMessage extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $message_to_send = "";
    public $first_name_to_send = "";

    public function __construct($first_name, $message)
    {
        $this->first_name_to_send = $first_name;
        $this->message_to_send = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email/contactmessageemail', compact('first_name_to_send', 'message_to_send'));
    }
}
