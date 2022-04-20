<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = "admin";
        $user->email = "admin@admin.com";
        $user->password = Hash::make("12345678");
        $user->save();
        $user = new User();
        $user->name = "nahid";
        $user->email = "nahid@admin.com";
        $user->password = Hash::make("12345678");
        $user->save();
        $user = new User();
        $user->name = "imran";
        $user->email = "imran@admin.com";
        $user->password = Hash::make("12345678");
        $user->save();
        $user = new User();
        $user->name = "fysal";
        $user->email = "fysal@admin.com";
        $user->password = Hash::make("12345678");
        $user->save();
    }
}
