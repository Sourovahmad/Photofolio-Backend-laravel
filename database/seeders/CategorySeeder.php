<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                "name" => "Category one",
                "description" => null
            ],
            [
                "name" => "Category Two",
                "description" => null
            ],
            [
                "name" => "Category Three",
                "description" => null
            ],
            [
                "name" => "Category Four",
                "description" => null
            ]
        ]);
    }
}
