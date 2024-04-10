<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(TagsSeeder::class);
        $this->call(CategoriesSeeder::class);
        $this->call(FieldsSeeder::class);
    }
}