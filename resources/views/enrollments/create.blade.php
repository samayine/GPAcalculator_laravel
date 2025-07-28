@extends('layout.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4>Enroll Student in Course</h4>
            </div>
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('enrollments.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="student_id" class="form-label">Student</label>
                                <select name="student_id" class="form-select @error('student_id') is-invalid @enderror" required>
                                    <option value="">Select a student...</option>
                                    @foreach($students as $student)
                                        <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>
                                            {{ $student->name }} ({{ $student->email }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('student_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="course_id" class="form-label">Course</label>
                                <select name="course_id" class="form-select @error('course_id') is-invalid @enderror" required>
                                    <option value="">Select a course...</option>
                                    @foreach($courses as $course)
                                        <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                            {{ $course->name }} ({{ $course->credit_hours }} credits)
                                        </option>
                                    @endforeach
                                </select>
                                @error('course_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="score" class="form-label">Score (0-100)</label>
                        <input type="number" name="score" class="form-control @error('score') is-invalid @enderror" 
                               value="{{ old('score') }}" min="0" max="100" required>
                        <div class="form-text">Enter the student's score for this course (0-100).</div>
                        @error('score')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Enroll Student</button>
                        <a href="{{ route('students.index') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h5>Grade Scale</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <span class="badge bg-success">A+ (90+)</span> = 4.0 points
                    </div>
                    <div class="col-md-3">
                        <span class="badge bg-success">A (85-90)</span> = 4.0 points
                    </div>
                    <div class="col-md-3">
                        <span class="badge bg-info">B (70-75)</span> = 3.0 points
                    </div>
                    <div class="col-md-3">
                        <span class="badge bg-warning">C (50-60)</span> = 2.0 points
                    </div>
                    <div class="col-md-3">
                        <span class="badge bg-danger">D (40-45)</span> = 1.0 points
                    </div>
                </div>
                <div class="mt-2">
                    <span class="badge bg-secondary">F (0-39)</span> = 0.0 points
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
