<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\{SubCategory,Order,ServiceReview,ServiceMedia,JobOffer,User};
use Carbon\Carbon;

class Service extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'user_id',
        'category_id',
        'sub_category_id',
        's_description',
        'description',
        'price',
        'rating',
        'lat',
        'lng',
        'revision',
        'total_orders',
        'total_reviews',
        'total_clicks',
        'delivery_time',
        'additional_info',
    ];

    protected $cast = [
        'status'=>'integer',
        'featured' => 'integer',
    ];

    public function getCreatedAtAttribute($value)
    {
        $carbonDate = new Carbon($value);
        return $carbonDate->diffForHumans();
    }

    public function setCategoryIdAttribute($value)
    {
        $this->attributes['category_id'] = customDecrypt($value);
    }
    public function setSubCategoryIdAttribute($value)
    {
        $this->attributes['sub_category_id'] = customDecrypt($value);
    }
    public function seller()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function UserService()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class,'sub_category_id');
    }
    public function serviceMedia()
    {
        return $this->hasMany(ServiceMedia::class);
    }
    public function ServiceReview()
    {
        return $this->hasMany(ServiceReview::class);
    }
    public function JobOffer()
    {
        return $this->hasMany(JobOffer::class,'service_id');
    }
    public function order()
    {
        return $this->hasMany(Order::class,'service_id');
    }


    // protected static function boot()
    // {
    //     parent::boot();
    //     static::deleting(function($service){
    //         $service->ServiceMedia->each(function($banner){
    //             if($banner->media && file_exists($banner->media)){
    //                 unlink($banner->media);
    //             }
    //             $banner->delete();
    //         });
    //     });
    // }
}
