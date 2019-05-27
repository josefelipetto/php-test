<?php

namespace App\Mail;

use App\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ClientSubscribed extends Mailable
{
    use Queueable, SerializesModels;

    protected $product;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('jose.felipetto@gmail.com') // no-reply@smallcommerce.com
                     ->view('emails.clientsubscribed')
                    ->with([
                        'product' => $this->product
                    ]);
    }
}
