<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tags')->insert([
            ['name' => 'Default Tag', 'created_by' => 1, 'bg_color' => '#11DFB6', 'color'=> '#000000', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
