@extends('layout.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Student Details</h3>
    <div>
        <a href="{{ route('students.index') }}" class="btn btn-secondary">Back to List</a>
        <a href="{{ route('enrollments.create') }}" class="btn btn-success">Add Enrollment</a>
        <form action="{{ route('students.destroy', $student) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this student? This action cannot be undone.');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete Student</button>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5>Student Information</h5>
            </div>
            <div class="card-body">
                <p><strong>Name:</strong> {{ $student->name }}</p>
                <p><strong>Email:</strong> {{ $student->email }}</p>
                <p><strong>Total Courses:</strong> {{ $student->enrollments->count() }}</p>
                <p><strong>GPA:</strong> 
                    <span class="badge bg-{{ $student->calculateGPA() >= 3.0 ? 'success' : ($student->calculateGPA() >= 2.0 ? 'warning' : 'danger') }} fs-6">
                        {{ number_format($student->calculateGPA(), 2) }}
                    </span>
                </p>
            </div>
        </div>
    </div>
    
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5>Course Enrollments & Grades</h5>
            </div>
            <div class="card-body">
                @if($student->enrollments->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Course</th>
                                    <th>Credit Hours</th>
                                    <th>Score</th>
                                    <th>Letter Grade</th>
                                    <th>Grade Points</th>
                                    <th>Quality Points</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($student->enrollments as $enrollment)
                                    <tr>
                                        <td>{{ $enrollment->course->name }}</td>
                                        <td>{{ $enrollment->course->credit_hours }}</td>
                                        <td>{{ $enrollment->score }}</td>
                                        <td>
                                            <span class="badge bg-{{ $enrollment->letter_grade === 'A' ? 'success' : ($enrollment->letter_grade === 'B' ? 'info' : ($enrollment->letter_grade === 'C' ? 'warning' : 'danger')) }}">
                                                {{ $enrollment->letter_grade }}
                                            </span>
                                        </td>
                                        <td>{{ $enrollment->grade_point }}</td>
                                        <td>{{ number_format($enrollment->course->credit_hours * $enrollment->grade_point, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="table-dark">
                                <tr>
                                    <td colspan="2"><strong>Total</strong></td>
                                    <td colspan="3"></td>
                                    <td><strong>{{ number_format($student->enrollments->sum(function($e) { return $e->course->credit_hours * $e->grade_point; }), 2) }}</strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    
                    <div class="mt-3">
                        <h6>GPA Calculation:</h6>
                        <p class="mb-1">Total Quality Points: {{ number_format($student->enrollments->sum(function($e) { return $e->course->credit_hours * $e->grade_point; }), 2) }}</p>
                        <p class="mb-1">Total Credit Hours: {{ $student->enrollments->sum('course.credit_hours') }}</p>
                        <p class="mb-0"><strong>GPA = {{ number_format($student->enrollments->sum(function($e) { return $e->course->credit_hours * $e->grade_point; }), 2) }} ÷ {{ $student->enrollments->sum('course.credit_hours') }} = {{ number_format($student->calculateGPA(), 2) }}</strong></p>
                    </div>
                @else
                    <div class="text-center py-4">
                        <p class="text-muted">No course enrollments found for this student.</p>
                        <a href="{{ route('enrollments.create') }}" class="btn btn-primary">Add First Enrollment</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
