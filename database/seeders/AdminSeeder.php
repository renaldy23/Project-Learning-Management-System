<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            "name" => "Superadmin",
            "username" => "admin1234",
            "password" => Hash::make("secret"),
            "password_without_hash" => "secret",
            "status" => "active"
        ]);
    }
}
