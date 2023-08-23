<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable=[
            'category_id',
            'title',
            'fi_title',
            'active',
            'banner'
        ];

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
}
