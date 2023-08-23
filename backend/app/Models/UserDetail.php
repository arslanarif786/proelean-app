<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class UserDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'balance',
        'user_id',
        'freelancer_title',
        'description',
        'availability',
        'lang',
        'category_id',
        'sub_category_id',
        'country_id',
        'cinic',
        'is_verified',
        'active',
        'facebook',
        'linked_in',
        'portfolio',
        'google_plus',
        'twitter',
        'instagram',
    ];

    public function setCategoryIdAttribute($value)
    {
        $this->attributes['category_id'] = customDecrypt($value);
    }
    public function setSubCategoryIdAttribute($value)
    {
        $this->attributes['sub_category_id'] = customDecrypt($value);
    }
    public function setCountryIdAttribute($value)
    {
        $this->attributes['country_id'] = customDecrypt($value);
    }
    public function setSubUserIdAttribute($value)
    {
        $this->attributes['user_id'] = customDecrypt($value);
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
