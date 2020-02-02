<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserVerification extends Mailable
{

    use Queueable,
        SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userDetails)
    {
        $this->userDetails = $userDetails;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.user-verification')
                        ->from('tester9560@gmail.com', 'PPMHUB')
                        ->replyTo('tester9560@gmail.com', 'PPMHUB')
                        ->subject('You are invited to join PPMHUB')
                        ->with(['user_details' => $this->userDetails]);
    }

}
