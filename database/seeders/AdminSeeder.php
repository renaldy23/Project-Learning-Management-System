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
        $data = [
            [
                "name" => "Superadmin",
                "username" => "admin1234",
                "password" => Hash::make("secret"),
                "password_without_hash" => "secret",
                "status" => "active"
            ],
            [
                "name" => "Admin01",
                "username" => "admin",
                "password" => Hash::make("admin"),
                "password_without_hash" => "admin",
                "status" => "active"
            ]
        ];
        foreach ($data as $d) {
            DB::table('admins')->insert($d);
        }
    }
}
