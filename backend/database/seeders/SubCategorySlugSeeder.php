<?php

namespace Database\Seeders;

use App\Models\SubCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SubCategorySlugSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = SubCategory::get();

        for ($i = 0; $i < sizeof($categories); $i++) {

            if (is_null($categories[$i]->slug) || !$categories[$i]->slug)
                $categories[$i]->slug = Str::slug($categories[$i]->title, '-');

            $this->checkIfSlugAlreadyExistOrNot($categories[$i]);
        }
    }

    private function checkIfSlugAlreadyExistOrNot($category)
    {

        $slugAlreadyExist = SubCategory::where('slug',$category->slug)->first();

        if($slugAlreadyExist) {

            // re-assign slug value & check it again if new slug exist.

            $category->slug = Str::of($category->slug)->append('-'. Str::singular(Str::random(5)) );

            $this->checkIfSlugAlreadyExistOrNot($category);

        } else {

            // save it
            SubCategory::where('id',$category->id)->update(['slug' => $category->slug]);
        }
    }
}
