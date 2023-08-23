<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id','service_id','device_id'
    ];

    public function setServiceIdAttribute($value)
    {
        $this->attributes['service_id']=customDecrypt($value);
    }
}
