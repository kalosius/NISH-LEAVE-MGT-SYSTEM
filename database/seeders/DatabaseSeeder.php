<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use App\Models\Department;
use App\Models\LeaveType;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ------------------------------
        // 1️⃣ Seed Roles (Prevent Duplicates)
        // ------------------------------
        $roles = [
            ['name' => 'Admin'],
            ['name' => 'Department Head'],
            ['name' => 'Employee'],
        ];

        foreach ($roles as $role) {
            DB::table('roles')->updateOrInsert(
                ['name' => $role['name']],
                $role
            );
        }

        // ------------------------------
        // 2️⃣ Seed Leave Types
        // ------------------------------
        $leaveTypes = [
            [
                'name' => 'Annual',
                'description' => 'Annual vacation leave',
                'max_days' => 21,
            ],
            [
                'name' => 'Sick',
                'description' => 'Sick leave for medical reasons',
                'max_days' => 14,
            ],
            [
                'name' => 'Emergency',
                'description' => 'Emergency leave for urgent matters',
                'max_days' => 7,
            ],
            [
                'name' => 'Maternity',
                'description' => 'Maternity leave',
                'max_days' => 84,
            ],
            [
                'name' => 'Paternity',
                'description' => 'Paternity leave',
                'max_days' => 7,
            ],
        ];

        foreach ($leaveTypes as $type) {
            LeaveType::updateOrCreate(
                ['name' => $type['name']],
                $type
            );
        }

        // ------------------------------
        // 3️⃣ Seed Departments (Prevent Duplicates)
        // ------------------------------
        $departments = [
            ['name' => 'Human Resources', 'head_id' => null],
            ['name' => 'Finance', 'head_id' => null],
            ['name' => 'IT', 'head_id' => null],
            ['name' => 'Assembly', 'head_id' => null],
            ['name' => 'Spare Parts', 'head_id' => null],
            ['name' => 'Mechanical', 'head_id' => null],
            ['name' => 'Electrical', 'head_id' => null],
            ['name' => 'Painting', 'head_id' => null],
            ['name' => 'Quality Control', 'head_id' => null],
            ['name' => 'Logistics', 'head_id' => null],
            ['name' => 'Sales & Marketing', 'head_id' => null],
        ];

        foreach ($departments as $dept) {
            DB::table('departments')->updateOrInsert(
                ['name' => $dept['name']],
                $dept
            );
        }

        // ------------------------------
        // 4️⃣ Seed Users (Prevent Duplicates)
        // ------------------------------
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
            ],
            // Employees
            [
                'first_name' => 'John',
                'last_name' => 'Doe',
                'email' => 'john@example.com',
                'password' => Hash::make('password123'),
                'role_id' => 3,
                'department_id' => 1,
                'phone' => '+255 123 456 783',
                'date_of_birth' => '1990-05-15',
                'gender' => 'male',
                'address' => '111 Employee Lane, Dar es Salaam',
                'emergency_contact' => '+255 789 123 453 (Jane Doe)',
                'employment_type' => 'full_time',
                'join_date' => '2022-01-10',
                'status' => 'active',
            ],
            [
                'first_name' => 'Jane',
                'last_name' => 'Smith',
                'email' => 'jane@example.com',
                'password' => Hash::make('password123'),
                'role_id' => 3,
                'department_id' => 2,
                'phone' => '+255 123 456 784',
                'date_of_birth' => '1992-08-22',
                'gender' => 'female',
                'address' => '222 Worker Street, Dar es Salaam',
                'emergency_contact' => '+255 789 123 454 (Bob Smith)',
                'employment_type' => 'full_time',
                'join_date' => '2022-03-15',
                'status' => 'active',
            ],
            [
                'first_name' => 'Bob',
                'last_name' => 'Johnson',
                'email' => 'bob@example.com',
                'password' => Hash::make('password123'),
                'role_id' => 3,
                'department_id' => 3,
                'phone' => '+255 123 456 785',
                'date_of_birth' => '1988-12-10',
                'gender' => 'male',
                'address' => '333 Staff Avenue, Dar es Salaam',
                'emergency_contact' => '+255 789 123 455 (Alice Johnson)',
                'employment_type' => 'full_time',
                'join_date' => '2021-11-05',
                'status' => 'active',
            ],
            // Additional Employees for different departments
            [
                'first_name' => 'Mugisha',
                'last_name' => 'Andrew',
                'email' => 'mugisha.andrew@nishauto.com',
                'password' => Hash::make('password123'),
                'role_id' => 3,
                'department_id' => 4, // Assembly
                'phone' => '+255 712 345 678',
                'date_of_birth' => '1990-03-15',
                'gender' => 'male',
                'address' => '123 Main Street, Dar es Salaam, Tanzania',
                'emergency_contact' => '+255 754 321 098 (Sarah Andrew)',
                'employment_type' => 'full_time',
                'join_date' => '2022-01-15',
                'status' => 'active',
            ],
        ];

        foreach ($users as $userData) {
            User::updateOrCreate(
                ['email' => $userData['email']],
                $userData
            );
        }

        // ------------------------------
        // 5️⃣ Assign Department Heads to Departments
        // ------------------------------
        $hrHead = User::where('email', 'hrhead@example.com')->first();
        $financeHead = User::where('email', 'financehead@example.com')->first();
        $itHead = User::where('email', 'ithead@example.com')->first();

        if ($hrHead) {
            DB::table('departments')->where('id', 1)->update(['head_id' => $hrHead->id]);
        }
        if ($financeHead) {
            DB::table('departments')->where('id', 2)->update(['head_id' => $financeHead->id]);
        }
        if ($itHead) {
            DB::table('departments')->where('id', 3)->update(['head_id' => $itHead->id]);
        }

        $this->command->info('Database seeded successfully!');
    }
}