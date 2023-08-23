<?php

namespace Database\Seeders;

use App\Models\TermCondition;
use Illuminate\Database\Seeder;


class TermConditionSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        TermCondition::factory(1)->create();
    }
}
