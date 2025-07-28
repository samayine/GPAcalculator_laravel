<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email'];

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function calculateGPA()
    {
        $totalCredits = 0;
        $totalPoints = 0;

        foreach ($this->enrollments as $enrollment) {
            $credit = $enrollment->course->credit_hours;
            $point = $enrollment->grade_point;

            $totalCredits += $credit;
            $totalPoints += ($credit * $point);
        }

        return $totalCredits > 0 ? round($totalPoints / $totalCredits, 2) : 0.0;
    }
}
