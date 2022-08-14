<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderDispatched extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $tracking;
    public $terminal;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order, $tracking, $terminal)
    {
        $this->order = $order;
        $this->tracking = $tracking;
        $this->terminal = $terminal;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.dispatched');
    }
}
