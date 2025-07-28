<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        Student::create([
            'name' => 'Samuel Ayine',
            'email' => 'sam@gmail.com',
        ]);

        Student::create([
            'name' => 'Jonas Gebru',
            'email' => 'jonas@gmail.com',
        ]);

        Student::create([
            'name' => 'Abebe Kebede',
            'email' => 'abeKebe@gmail.com',
        ]);
    }
}
