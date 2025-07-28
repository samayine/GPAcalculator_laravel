@extends('layout.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Students List (Sorted by GPA)</h3>
    <div>
        <a href="{{ route('students.create') }}" class="btn btn-primary">Add Student</a>
        <a href="{{ route('enrollments.create') }}" class="btn btn-success">Add Enrollment</a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>GPA</th>
                <th>Courses Taken</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @forelse($students as $student)
            <tr>
                <td>{{ $student->id }}</td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->email }}</td>
                <td>
                    <span class="badge bg-{{ $student->calculateGPA() >= 3.0 ? 'success' : ($student->calculateGPA() >= 2.0 ? 'warning' : 'danger') }}">
                        {{ number_format($student->calculateGPA(), 2) }}
                    </span>
                </td>
                <td>{{ $student->enrollments->count() }}</td>
                <td>
                    <a href="{{ route('students.show', $student->id) }}" class="btn btn-info btn-sm">View Details</a>
                </td>
                <td>
                    <form action="{{ route('students.destroy', $student) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this student? This action cannot be undone.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Student</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center">No students found.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
