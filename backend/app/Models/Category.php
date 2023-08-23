<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'categories';
    protected $fillable = [
            'title',
            'fi_title',
            'description',
            'banner',
            'actuve',
        ];
    public function sub_menu(){
        return $this->hasMany(SubCategory::class,'category_id');
    }
}
