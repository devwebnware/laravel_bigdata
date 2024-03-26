<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Developer',
            'email' => 'developer@webnware.com',
            'password' => bcrypt('abc2@bcr')
        ]);
        $admin->assignRole('admin');
    }
}
