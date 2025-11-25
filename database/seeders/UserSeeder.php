<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            // Admin
            [
                'first_name' => 'Admin',
                'last_name' => 'User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password123'),
                'role_id' => 1,
                'department_id' => null,
                'phone' => '+255 123 456 789',
                'date_of_birth' => '1985-01-15',
                'gender' => 'male',
                'address' => '123 Admin Street, Dar es Salaam',
                'emergency_contact' => '+255 789 123 456 (Sarah User)',
                'employment_type' => 'full_time',
                'join_date' => '2020-01-01',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Department Heads
            [
                'first_name' => 'HR',
                'last_name' => 'Head',
                'email' => 'hrhead@example.com',
                'password' => Hash::make('password123'),
                'role_id' => 2,
                'department_id' => 1,
                'phone' => '+255 123 456 780',
                'date_of_birth' => '1980-03-20',
                'gender' => 'female',
                'address' => '456 HR Avenue, Dar es Salaam',
                'emergency_contact' => '+255 789 123 450 (John Head)',
                'employment_type' => 'full_time',
                'join_date' => '2021-02-15',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Finance',
                'last_name' => 'Head',
                'email' => 'financehead@example.com',
                'password' => Hash::make('password123'),
                'role_id' => 2,
                'department_id' => 2,
                'phone' => '+255 123 456 781',
                'date_of_birth' => '1978-07-12',
                'gender' => 'male',
                'address' => '789 Finance Road, Dar es Salaam',
                'emergency_contact' => '+255 789 123 451 (Mary Head)',
                'employment_type' => 'full_time',
                'join_date' => '2019-08-10',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'IT',
                'last_name' => 'Head',
                'email' => 'ithead@example.com',
                'password' => Hash::make('password123'),
                'role_id' => 2,
                'department_id' => 3,
                'phone' => '+255 123 456 782',
                'date_of_birth' => '1982-11-05',
                'gender' => 'male',
                'address' => '321 IT Boulevard, Dar es Salaam',
                'emergency_contact' => '+255 789 123 452 (Lisa Head)',
                'employment_type' => 'full_time',
                'join_date' => '2020-03-22',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']],
                $user
            );
        }
    }
}