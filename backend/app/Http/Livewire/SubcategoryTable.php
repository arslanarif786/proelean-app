<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\SubCategory;
use Livewire\Component;

class SubcategoryTable extends Component
{


    public function render()
    {
        $sub_categories=Category::select('sub_categories.id as ID','sub_categories.title','categories.title as category_name','sub_categories.banner as image')->join('sub_categories', 'sub_categories.category_id', '=', 'categories.id')->whereNull('sub_categories.deleted_at')->get();
		$categories=Category::get();
       // echo "<pre>";print_r($categories);die;
        return view('livewire.subcategory-table')->with(['sub_categories' => $sub_categories,'categories'=>$categories]);
    }
}
