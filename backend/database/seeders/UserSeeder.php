<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user[0]=[
            'name'=>'User 1',
            'username' => 'user1',
            'email' => 'user@proelean.com',
            'password' => bcrypt('11223344'),
            'user_type' => 'user',
            'verified' => 1,
        ];

        $user[1]=[
            'name'=>'User 2',
            'username' => 'user2',
            'email' => 'user2@proelean.com',
            'password' => bcrypt('11223344'),
            'user_type' => 'user',
            'verified' => 1,
        ];
        User::create($user[0]);
        User::create($user[1]);

    }
}
