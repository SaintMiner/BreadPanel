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
        $user = User::create(['username' => 'Admin', 'password' => Hash::make('password')]);
        $user->assignRole('super-admin');
    }
}
