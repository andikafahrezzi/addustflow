<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        $adminRoleId = DB::table('roles')
            ->where('name', 'admin')
            ->value('id');

        DB::table('users')->insert([
            'name' => 'Super Admin',
            'email' => 'admin@erp.test',
            'password' => Hash::make('admin123'),
            'role_id' => $adminRoleId,
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
