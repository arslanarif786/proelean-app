<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\JobOffer;
use App\Models\Order;
use App\Models\Category;
use App\Models\SubCategory;

class Job extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'category_id',
        'sub_category_id',
        'description',
        'budget',
        'delivery_time',
        'status',
        'active',
        'featured',
        'cinic',
        'doc_type',
        'apply_before',
        'min_qualification',
        'max_salary',
        'min_salary',
        'total_clicks',
        'offers',
        'lat',
        'lng',
    ];

    protected $cast=[
        'category_id'=>'integer',
        'sub_category_id'=>'integer'
        ];

    public function setCategoryIdAttribute($value)
    {
        $this->attributes['category_id'] = customDecrypt($value);
    }
    public function setSubCategoryIdAttribute($value)
    {
        $this->attributes['sub_category_id'] = customDecrypt($value);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function sub_category()
    {
        return $this->belongsTo(SubCategory::class);
    }
    public function JobOffer()
    {
        return $this->hasMany(JobOffer::class,'job_id');
    }
    public function order()
    {
        return $this->hasMany(Order::class);
    }
    public function CancelOffer()
    {
        return $this->hasMany(CancelOffer::class);
    }


    public  static function boot() {
            parent::boot();

            static::deleting(function($job) {
                JobOffer::where('job_id', $job->id)->delete();
            });
        }
}
