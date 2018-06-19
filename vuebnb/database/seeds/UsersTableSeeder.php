<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(array(
            'name' => 'Jane Doe',
            'email' => 'test@gmail.com',
            'password' => Hash::make('test'),
            'saved' => array(1, 5, 7, 9)
        ));
    }
}
