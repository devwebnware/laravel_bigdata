<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create admin user
        $admin = User::create([
            'name' => 'Developer',
            'email' => 'developer@bigdata.com',
            'password' => bcrypt('abc2@bcr')
        ]);
        $admin->assignRole('admin');

        // Create client user
        $client = User::create([
            'name' => 'Client',
            'email' => 'client@bigdata.com',
            'password' => bcrypt('abc2@bcr')
        ]);
        $client->assignRole('client');
    }
}
