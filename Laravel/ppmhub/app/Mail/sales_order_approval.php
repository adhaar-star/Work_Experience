<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class sales_order_approval extends Mailable {

    use Queueable,
        SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($sales_order) {
        $this->sales_order = $sales_order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this->view('email.sales-order-approval')
                ->from('tester9560@gmail.com', 'PPMHUB')
                ->replyTo('tester9560@gmail.com','PPMHUB')
                ->subject('Sales Order Approval - <PPMHUB>')
                ->with(['sales_order'=>$this->sales_order]);
    }

}
