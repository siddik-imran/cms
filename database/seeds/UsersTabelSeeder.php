<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'administrator@gmail.com')->first();

        if(!$user){
            User::create([
                'name' => 'Administrator',
                'email' => 'administrator@gmail.com',
                'password' => Hash::make('password')
            ]);
        }
    }
}
