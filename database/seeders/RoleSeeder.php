<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('roles')->insert([
            ['name' => 'Admin'],             // HR/Admin
            ['name' => 'Department Head'],   // Head of department
            ['name' => 'Employee'],          // Regular employee
        ]);
    }
}
