<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Service;

class ServiceStat extends Model
{
    use HasFactory;
    protected $fillable = [
        'service_id',
        'total_clicks',
        'device_id',
        'ip_address'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class,'service_id');
    }
}
