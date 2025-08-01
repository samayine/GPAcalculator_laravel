<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $courses = [
            ['name' => 'DSA', 'credit_hours' => 5],
            ['name' => 'Networking', 'credit_hours' => 4],
            ['name' => 'Software', 'credit_hours' => 7],
            ['name' => 'calculus', 'credit_hours' => 3],
            ['name' => 'Operating System', 'credit_hours' => 5],
            ['name' => 'Automata', 'credit_hours' => 6],

        ];

        foreach ($courses as $courseData) {
            Course::firstOrCreate(
                ['name' => $courseData['name']], // Check by name
                ['credit_hours' => $courseData['credit_hours']] // Only create if doesn't exist
            );
        }
    }
}
