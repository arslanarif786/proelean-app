<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Job;
use App\Models\User;
use App\Models\Service;

class JobOffer extends Model
{
    use HasFactory;
    protected $fillable = [
        'job_id',
        'user_id',
        'service_id',
        'description',
        'price',
        'delivery_time',
        'status'
    ];

    public function job()
    {
        return $this->belongsTo(Job::class,'job_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function Service()
    {
        return $this->belongsTo(Service::class,'service_id');
    }
}
