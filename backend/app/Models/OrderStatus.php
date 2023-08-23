<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_status'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class,'status_id');
    }
}
