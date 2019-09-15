<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email','uthman@gmail.com')->first();

        if (!$user){
            User::create(
                [
                    'name' => 'Ayinde Uthman',
                    'email' => 'uthman@gmail.com',
                    'role' => 'admin',
                    'password' => Hash::make('password')
                ]
            );
        }
    }
}
