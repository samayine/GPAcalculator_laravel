<?php

namespace App\Http\Controllers;

use App\Models\{Student, Course, Enrollment};
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function create()
    {
        $students = Student::all();
        $courses = Course::all();
        return view('enrollments.create', compact('students', 'courses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'score' => 'required|integer|min:0|max:100',
        ]);

        // Check if enrollment already exists
        $existingEnrollment = Enrollment::where('student_id', $validated['student_id'])
            ->where('course_id', $validated['course_id'])
            ->first();

        if ($existingEnrollment) {
            return back()->withErrors(['error' => 'Student is already enrolled in this course.']);
        }

        $letter = Enrollment::getLetterGrade($validated['score']);
        $point = Enrollment::getGradePoint($letter);

        Enrollment::create([
            ...$validated,
            'letter_grade' => $letter,
            'grade_point' => $point,
        ]);

        return redirect()->route('students.index')->with('success', 'Enrollment recorded successfully.');
    }

    public function edit(Enrollment $enrollment)
    {
        $students = Student::all();
        $courses = Course::all();
        return view('enrollments.edit', compact('enrollment', 'students', 'courses'));
    }

    public function update(Request $request, Enrollment $enrollment)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'score' => 'required|integer|min:0|max:100',
        ]);

        // Check if enrollment already exists for different student-course combination
        $existingEnrollment = Enrollment::where('student_id', $validated['student_id'])
            ->where('course_id', $validated['course_id'])
            ->where('id', '!=', $enrollment->id)
            ->first();

        if ($existingEnrollment) {
            return back()->withErrors(['error' => 'Student is already enrolled in this course.']);
        }

        $letter = Enrollment::getLetterGrade($validated['score']);
        $point = Enrollment::getGradePoint($letter);

        $enrollment->update([
            ...$validated,
            'letter_grade' => $letter,
            'grade_point' => $point,
        ]);

        return redirect()->route('students.show', $enrollment->student_id)->with('success', 'Enrollment updated successfully.');
    }

    public function destroy(Enrollment $enrollment)
    {
        $studentId = $enrollment->student_id;
        $enrollment->delete();
        
        return redirect()->route('students.show', $studentId)->with('success', 'Enrollment deleted successfully.');
    }
}
