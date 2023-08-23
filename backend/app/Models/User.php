<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\UserLanguage;
use App\Models\Service;
use App\Models\UserSkill;
use App\Models\FcmToken;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'image',
        'bankaccount_verified',
        'available_balance',
        'address',
        'latitude',
        'longitude',
        'city',
        'postal_code',
        'user_type',
        'isFreelancer',
        'phone',
        'rating',
        'total_reviews',
        'active',
        'status',
        'lang',
        'description',
        'verified',
        'referal_code',
        'user_type',
        'total_clicks',
        'stripe_account',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'active',
        'email_verified_at',
        'verified'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'active' => 'integer',
        'isFreelancer' => 'integer',
        'verified' => 'integer',
        'status' => 'integer',
        'stripe_account' => 'object',
    ];

    public function fcmTokens()
    {
        return $this->hasMany(FcmToken::class);
    }
    public function Freelancer()
    {
        return $this->hasOne(UserDetail::class, 'user_id');
    }
    public function Services()
    {
        return $this->hasMany(Service::class, 'user_id');
    }
    public function UserLanguages()
    {
        return $this->hasMany(UserLanguage::class, 'user_id');
    }
    public function UserSkills()
    {
        return $this->hasMany(UserSkill::class, 'user_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function Buyer()
    {
        return $this->hasMany(Order::class, 'user_id');
    }

    public function Seller()
    {
        return $this->hasMany(Order::class, 'seller_id');
    }
}
