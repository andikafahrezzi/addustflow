<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeesSeeder extends Seeder
{
    public function run(): void
    {
        $adminUserId = DB::table('users')
            ->where('email', 'admin@erp.test')
            ->value('id');

        DB::table('employees')->insert([
            'user_id' => $adminUserId,
            'position' => 'System Administrator',
            'join_date' => now()->toDateString(),
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
