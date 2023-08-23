<?php

namespace Database\Seeders;

use App\Models\OrderStatus;
use App\Models\PrivacyPolicy;
use Illuminate\Database\Seeder;
use App\Models\TermCondition;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdminSeeder::class,
            UserSeeder::class,
            SettingSeeder::class,
            CategorySeeder::class,
            SubCategorySeeder::class,
            CountrySeeder::class,
            DeliveryDaySeeder::class,
            AddsSeeder::class,
        ]);

        PrivacyPolicy::factory(1)->create();
        TermCondition::factory(1)->create();
        for($i=1;$i<9;$i++){
            OrderStatus::create([
                'order_status'=>$i
            ]);
        }
    }
}
