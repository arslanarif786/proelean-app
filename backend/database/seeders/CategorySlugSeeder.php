<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySlugSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = Category::get();

        for ($i = 0; $i < sizeof($categories); $i++) {

            if (is_null($categories[$i]->slug) || !$categories[$i]->slug)
                $categories[$i]->slug = Str::slug($categories[$i]->title, '-');

            $this->checkIfSlugAlreadyExistOrNot($categories[$i]);
        }
    }

    private function checkIfSlugAlreadyExistOrNot($category)
    {

        $slugAlreadyExist = Category::where('slug',$category->slug)->first();

        if($slugAlreadyExist) {

            // re-assign slug value & check it again if new slug exist.

            $category->slug = Str::of($category->slug)->append('-'. Str::singular(Str::random(5)) );

            $this->checkIfSlugAlreadyExistOrNot($category);

        } else {

            // save it
            Category::where('id',$category->id)->update(['slug' => $category->slug]);
        }
    }
}
