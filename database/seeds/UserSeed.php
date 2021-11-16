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
        if (!User::where('email', 'pabloroxo@gmail.com')->first()) {
            $user = new User;
            $user->name = 'Pablo Roxo';
            $user->email = 'pabloroxo@gmail.com';
            $user->password = 'password';
            $user->save();
        }
        if (!User::where('email', 'rogerionascimento.dev@gmail.com')->first()) {
            $user = new User;
            $user->name = 'Rogério Nascimento';
            $user->email = 'rogerionascimento.dev@gmail.com';
            $user->password = 'password';
            $user->save();
        }
    }
}
