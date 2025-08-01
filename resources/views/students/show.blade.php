<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Student Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium">Student Details</h3>
                        <div class="space-x-2">
                            <a href="{{ route('students.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Back to List
                            </a>
                            <a href="{{ route('enrollments.create') }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Add Enrollment
                            </a>
                            <form action="{{ route('students.destroy', $student) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this student? This action cannot be undone.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Delete Student
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <div class="lg:col-span-1">
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h5 class="text-lg font-medium text-gray-900 mb-4">Student Information</h5>
                                <div class="space-y-3">
                                    <div>
                                        <span class="font-bold text-gray-700">Name:</span>
                                        <span class="text-gray-900">{{ $student->name }}</span>
                                    </div>
                                    <div>
                                        <span class="font-bold text-gray-700">Email:</span>
                                        <span class="text-gray-900">{{ $student->email }}</span>
                                    </div>
                                    <div>
                                        <span class="font-bold text-gray-700">Total Courses:</span>
                                        <span class="text-gray-900">{{ $student->enrollments->count() }}</span>
                                    </div>
                                    <div>
                                        <span class="font-bold text-gray-700">GPA:</span>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $student->calculateGPA() >= 3.0 ? 'bg-green-100 text-green-800' : ($student->calculateGPA() >= 2.0 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                            {{ number_format($student->calculateGPA(), 2) }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="lg:col-span-2">
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h5 class="text-lg font-medium text-gray-900 mb-4">Course Enrollments & Grades</h5>
                                @if($student->enrollments->count() > 0)
                                    <div class="overflow-x-auto">
                                        <table class="min-w-full divide-y divide-gray-200">
                                            <thead class="bg-gray-100">
                                                <tr>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Course</th>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Credit Hours</th>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Score</th>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Letter Grade</th>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Grade Points</th>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quality Points</th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                @foreach($student->enrollments as $enrollment)
                                                    <tr>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $enrollment->course->name }}</td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $enrollment->course->credit_hours }}</td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $enrollment->score }}</td>
                                                        <td class="px-6 py-4 whitespace-nowrap">
                                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $enrollment->letter_grade === 'A' ? 'bg-green-100 text-green-800' : ($enrollment->letter_grade === 'B' ? 'bg-blue-100 text-blue-800' : ($enrollment->letter_grade === 'C' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800')) }}">
                                                                {{ $enrollment->letter_grade }}
                                                            </span>
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $enrollment->grade_point }}</td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ number_format($enrollment->course->credit_hours * $enrollment->grade_point, 2) }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot class="bg-gray-100">
                                                <tr>
                                                    <td colspan="5" class="px-6 py-4 text-sm font-medium text-gray-900">Total</td>
                                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ number_format($student->enrollments->sum(function($e) { return $e->course->credit_hours * $e->grade_point; }), 2) }}</td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    
                                    <div class="mt-6 bg-blue-50 rounded-lg p-4">
                                        <h6 class="font-medium text-blue-900 mb-2">GPA Calculation:</h6>
                                        <div class="space-y-1 text-sm text-blue-800">
                                            <p>Total Quality Points: {{ number_format($student->enrollments->sum(function($e) { return $e->course->credit_hours * $e->grade_point; }), 2) }}</p>
                                            <p>Total Credit Hours: {{ $student->enrollments->sum('course.credit_hours') }}</p>
                                            <p class="font-medium">GPA = {{ number_format($student->enrollments->sum(function($e) { return $e->course->credit_hours * $e->grade_point; }), 2) }} ÷ {{ $student->enrollments->sum('course.credit_hours') }} = {{ number_format($student->calculateGPA(), 2) }}</p>
                                        </div>
                                    </div>
                                @else
                                    <div class="text-center py-8">
                                        <p class="text-gray-500 mb-4">No course enrollments found for this student.</p>
                                        <a href="{{ route('enrollments.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                            Add First Enrollment
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
