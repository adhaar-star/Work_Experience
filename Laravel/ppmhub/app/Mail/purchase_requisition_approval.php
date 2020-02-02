<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class purchase_requisition_approval extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($purchase_requisition)
    {
        $this->purchase_requisition = $purchase_requisition;
      
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.purchase-requisition-approval')
                ->from('tester9560@gmail.com', 'PPMHUB')
                ->replyTo('tester9560@gmail.com','PPMHUB')
                ->subject('Purchase Requisition Approval - <PPMHUB>')
                ->with(['purchase_requisition'=>$this->purchase_requisition]);
    }
}
