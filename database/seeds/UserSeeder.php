<?php

use Illuminate\Database\Seeder;

use App\User;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create(['username' => 'Admin', 'password' => Hash::make('password'), 'crumbs' => 1000]);
        $user->assignRole('super-admin');
    }
}
