<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryTime extends Model
{
    use HasFactory;
    protected $fillable=[
        'days'
        ];

    protected $cast=[
        'days'=>'integer'
        ];

    public function getDayAttribute($value)
    {
        return (int)$value > 1 ? $value.' Days' : $value.' Day';
    }
}
