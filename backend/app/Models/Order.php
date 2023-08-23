<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{OrderStatus,Payment};
use App\Models\Service;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'seller_id',
        'service_id',
        'job_id',
        'amount',
        'description',
        'status',
        'orderNo',
        'type',
        'emailed',
        'revision_description',
        'status_id',
        'is_rated',
        'pre_status',
        'watch',
        'disputed_by',
        'notes',
        'started',
        'delivery_note',
        'delivered_file',
        'delivery_time',
        'revision',
        'end_date',
        'dispute'
    ];

    protected $casts = [
        'dispute' => 'object'
    ];

    public function status()
    {
        return $this->belongsTo(OrderStatus::class,'status_id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class,'payment_id');
    }

    public function Service()
    {
        return $this->belongsTo(Service::class,'service_id');
    }

    public function buyer()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function seller()
    {
        return $this->belongsTo(User::class,'seller_id');
    }
}
