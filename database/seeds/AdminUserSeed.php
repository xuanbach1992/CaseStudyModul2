<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user=new \App\User();
        $user->name="admin";
        $user->password=Hash::make("12345678");
        $user->email="admin@gmail.com";
        $user->role=\App\Http\Controllers\Auth\RoleConstrant::ADMIN;
        $user->save();
    }
}
