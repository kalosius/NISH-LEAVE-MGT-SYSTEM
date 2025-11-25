<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LeaveType;

class LeaveTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
            // Use updateOrCreate to avoid duplicates
            LeaveType::updateOrCreate(
                ['name' => $type['name']], // Check if name exists
                $type // Data to insert/update
            );
        }

        $this->command->info('Leave types seeded successfully!');
    }
}