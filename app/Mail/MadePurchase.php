<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MadePurchase extends Mailable
{
    use Queueable, SerializesModels;

    public $cart;
    public $order;
    public $purchase;
    public $omniva;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($cart, $order, $purchase, $omniva)
    {
        $this->cart = $cart;
        $this->order = $order;
        $this->purchase = $purchase;
        $this->omniva = $omniva;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($address = 'noreply@example.com', $name = 'Baryga.lt')
            ->subject('We have received your order!')
            ->view('emails.purchase');
    }
}
