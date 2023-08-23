<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{User,Order};


class OrderRefund extends Model
{
    use HasFactory;
    protected $fillable=[
        'order_id',
        'user_id',
        're_id',
        'object',
        'amount',
        'currency'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function order(){
        return $this->belongsTo(Order::class,'order_id');
    }

}
