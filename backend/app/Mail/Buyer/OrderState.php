<?php

namespace App\Mail\Buyer;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderState extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $order=[];
    public function __construct($data)
    {
        $this->order=$data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.buyer.order-state',[
            'url'=>'www.proelean.com',
            'seller_name'=>$this->order['seller_name'],
            'buyer_name'=>$this->order['buyer_name'],
            'order_no'=>$this->order['order_no'],
            'end_date'=>$this->order['end_date'],
            'state'=>$this->order['state']
        ]);
    }
}
