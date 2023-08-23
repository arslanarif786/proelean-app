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
        'amount'
    ];
}
