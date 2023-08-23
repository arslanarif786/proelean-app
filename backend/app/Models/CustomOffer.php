<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Service;

class CustomOffer extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'service_id',
        'price',
        'description',
        'delivery_time',
        'revision'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function Service()
    {
        return $this->belongsTo(Service::class,'service_id');
    }
}
