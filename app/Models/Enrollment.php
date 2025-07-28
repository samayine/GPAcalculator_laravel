<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'course_id', 'score', 'letter_grade', 'grade_point'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Score to letter grade converter
    public static function getLetterGrade($score)
    {
        return match(true) {
            $score >= 90     => 'A+',
            $score >= 85     => 'A',
            $score >= 80     => 'A−',
            $score >= 75     => 'B+',
            $score >= 70     => 'B',
            $score >= 65     => 'B−',
            $score >= 60     => 'C+',
            $score >= 50     => 'C',
            $score >= 45     => 'C−',
            $score >= 40     => 'D',
            default          => 'F',
        };
    }

    // Letter grade to grade point
    public static function getGradePoint($letter)
    {
        return match($letter) {
            'A+' => 4.0,
            'A'  => 4.0,
            'A−' => 3.75,
            'B+' => 3.5,
            'B'  => 3.0,
            'B−' => 2.75,
            'C+' => 2.5,
            'C'  => 2.0,
            'C−' => 1.75,
            'D'  => 1.0,
            'F'  => 0.0,
            default => 0.0,
        };
    }
}
