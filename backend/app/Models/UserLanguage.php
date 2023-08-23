<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class UserLanguage extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'languages'
    ];
    
    public function languages()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
