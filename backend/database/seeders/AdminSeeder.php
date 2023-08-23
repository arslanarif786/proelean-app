<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin=[
            'name'=>'Admin',
            'username' => 'admin',
            'email' => 'admin@proelean.com',
            'password' => bcrypt('11223344'),
            'user_type' => 'admin'
        ];
            User::create($admin);

    }
}
