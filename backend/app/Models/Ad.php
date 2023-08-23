<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Ad extends Model
{
    use HasFactory;
    protected $fillable=[
        'banner',
        'description',
        'action',
        'status',
    ];

    protected $hidden = ['status'];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

}
