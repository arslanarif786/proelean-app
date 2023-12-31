<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Service;

class ServiceReview extends Model
{
    use HasFactory;
    protected $fillable=[
        'service_id',
        'user_id',
        'rating',
        'description',
        'deleted',
        ];
        
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class,'service_id');
    }
}
