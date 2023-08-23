<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use Livewire\Component;

class PaymentTable extends Component
{


    public function render()
    {
        $userColumns='id,name';
        $payments=Order::select('orders.id','orderNo','type','orders.amount','orders.currency','user_id','seller_id','txn_id','brand','last4')
            ->with("buyer:$userColumns","seller:$userColumns")
            ->join('order_card_details','payment_id','=','order_card_details.id')->paginate(15);
        return view('livewire.payments-table')->with(['payments' => $payments]);
    }
}
