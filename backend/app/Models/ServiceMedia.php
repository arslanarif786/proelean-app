<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Service;

class ServiceMedia extends Model
{
    use HasFactory;
    protected $fillable = [
        'serivce_id',
        'type',
        'media',
        'status',
        'deleted',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class,'service_id');
    }
}
