<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;

class CategoryTable extends Component
{


    public function render()
    {
        $categories=Category::all(['id','title','banner']);
        return view('livewire.category-table')->with(['categories' => $categories]);
    }
}
