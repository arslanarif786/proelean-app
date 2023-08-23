<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'txn_id',
        'order_id',
        'brand',
        'description',
        'raw_response',
        'receipt_url',
        'currency',
        'amount',
        'seller_share',
        'deduction'
    ];

    protected $casts = [
        'raw_response' => 'object'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
