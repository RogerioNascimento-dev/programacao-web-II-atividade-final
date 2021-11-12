<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!User::where('email', 'pabloricardoroxosilva@gmail.com')->first()) {
            $user = new User;
            $user->name = 'Pablo Roxo';
            $user->email = 'pabloricardoroxosilva@gmail.com';
            $user->password = 'password';
            $user->save();
        }
    }
}
