<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Country;
use Illuminate\Support\Facades\Storage;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries=json_decode(file_get_contents(__DIR__.'/jsons/countries.json'));

        foreach($countries as $country){

            $item=[];
            foreach($country as $key=> $value)
            {
                $item[$key] = $value;
            }
            Country::create($item);
        }

    }
}
