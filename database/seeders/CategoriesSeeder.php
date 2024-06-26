<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{

    public function run(): void
    {
        DB::table('categories')->insert([
            ['name' => 'Default Category', 'created_by' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
