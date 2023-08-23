<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubCategory;

class ChildMenu extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'sub_category_id',
        'title',
        'banner',
        'status'
    ];

    public function submenu()
    {
        return $this->belongsTo(SubCategory::class,'sub_category_id');
    }
}
