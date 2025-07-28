<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\EnrollmentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('students.index');
});

Route::resource('students', StudentController::class)->only(['index', 'create', 'store', 'show', 'destroy']);
Route::resource('enrollments', EnrollmentController::class)->only(['create', 'store']);
