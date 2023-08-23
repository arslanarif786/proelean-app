<?php

namespace Database\Seeders;

use App\Models\AvailableLanguage;
use App\Models\DeliveryTime;
use App\Models\Revision;
use Illuminate\Database\Seeder;

class DeliveryDaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1;$i<60;$i++){
            DeliveryTime::create([
                'days'=>$i==1 ? $i." day" : $i." days",
            ]);
        }

        for($i=0;$i<6;$i++){
            Revision::create([
                'revision_count'=>$i,
            ]);
        }

    }
}
