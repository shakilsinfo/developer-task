<?php

use Illuminate\Database\Seeder;
use App\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'User1',
            'email' => 'user1@email.com',
            'password' => bcrypt('123456'),
            'user_type' => 1,
        ]);
        User::create([
            'name' => 'user2',
            'email' => 'user2@email.com',
            'password' => bcrypt('123456'),
            'user_type' => 1,
        ]);
    }
}
