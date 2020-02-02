<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class purchase_order_approval extends Mailable{
 use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($purchase_order)
    {
        $this->purchase_order = $purchase_order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.purchase_order_approval')
                ->from('tester9560@gmail.com', 'PPMHUB')
                ->replyTo('tester9560@gmail.com','PPMHUB')
                ->subject('Purchase Order Approval - <PPMHUB>')
                ->with(['purchase_order'=>$this->purchase_order]);
    }
}
