<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class QuotationMail extends Mailable {

    use Queueable,
        SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($quotation_data, $quotation_item) {
        $this->quotation_data = $quotation_data;
        $this->quotation_item = $quotation_item;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this->view('email.quotationpdfview')
        ->from('tester9560@gmail.com', 'PPMHUB')
        ->replyTo('tester9560@gmail.com', 'PPMHUB')
        ->subject('Quotation - <PPMHUB>')
        ->with(['quotation_data' => $this->quotation_data])
        ->with(['quotation_item' => $this->quotation_item]);
    }

}
