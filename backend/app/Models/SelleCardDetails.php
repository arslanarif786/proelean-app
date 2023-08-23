<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SelleCardDetails extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'iban',
        'bank_name',
        'bank_title',
    ];

}
