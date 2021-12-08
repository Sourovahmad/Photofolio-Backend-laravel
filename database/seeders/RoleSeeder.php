<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                "role" =>  "superadmin",
            ],
            [
                "role" =>  "admin",
            ],
            [
                "role" =>  "user",
            ],
        ]);

        DB::table('users')->insert([
            [
                "name" =>  "Super Admin",
                "email" =>  "superadmin@gmail.com",
                "password" =>  bcrypt(1234),
                "role_id" =>  1,
                "country" => "Bangladesh",
                "birth_date" => '01-01-2000'
            ],
            [
                "name" =>  "Admin",
                "email" =>  "admin@gmail.com",
                "password" =>  bcrypt(1234),
                "role_id" =>  2,
                "country" => "Bangladesh",
                "birth_date" => '01-01-2000'
            ],
            [
                "name" =>  "user",
                "email" =>  "user@gmail.com",
                "password" =>  bcrypt(1234),
                "role_id" =>  3,
                "country" => "Bangladesh",
                "birth_date" => '01-01-2000'
            ],
        ]);
    }
}
