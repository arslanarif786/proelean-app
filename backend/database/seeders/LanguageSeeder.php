<?php

namespace Database\Seeders;

use App\Models\AvailableLanguage;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $languages=['English','Finnish','Germany','Swedish','Spanish'];
        foreach($languages as $language){
            AvailableLanguage::create([
                'language'=>$language
            ]);
        }

    }
}
