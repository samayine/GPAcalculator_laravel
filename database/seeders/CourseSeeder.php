<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        Course::create(['name' => 'DSA', 'credit_hours' => 5]);
        Course::create(['name' => 'Networking', 'credit_hours' => 4]);
        Course::create(['name' => 'Software', 'credit_hours' => 7]);
        Course::create(['name' => 'calculus', 'credit_hours' => 3]);

    }
}
