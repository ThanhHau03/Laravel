<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

//Route::get('courses', [CourseController::class, 'index']);
//Route::get('courses/create', [CourseController::class, 'create'])->name('course.create');
//Route::post('courses/create', [CourseController::class, 'store'])->name('course.store');

//Route::group(['prefix' => 'courses', 'as' => 'course.'], function() {
//    Route::get('/', [CourseController::class, 'index'])->name('index');
//    Route::get('/create', [CourseController::class, 'create'])->name('create');
//    Route::post('/create', [CourseController::class, 'store'])->name('store');
//    Route::delete('/destroy/{course}', [CourseController::class, 'destroy'])->name('destroy');
//    Route::get('/edit/{course}', [CourseController::class, 'edit'])->name('edit');
//    Route::put('/edit/{course}', [CourseController::class, 'update'])->name('update');
//});

// viết sau sẽ ghi đè lên thằng viết trước
Route::resource('courses', CourseController::class)->except([
    'show',
]);
Route::get('courses/api', [CourseController::class, 'api'])->name('courses.api');
Route::get('courses/api/name', [CourseController::class, 'apiName'])->name('courses.api.name');

Route::group(['prefix' => 'student', 'as' => 'students.'], function() {
    Route::get('/', [StudentController::class, 'index'])->name('index');
    Route::get('/create', [StudentController::class, 'create'])->name('create');
    Route::post('/create', [StudentController::class, 'store'])->name('store');
    Route::delete('/destroy/{course}', [StudentController::class, 'destroy'])->name('destroy');
    Route::get('/edit/{course}', [StudentController::class, 'edit'])->name('edit');
    Route::put('/edit/{course}', [StudentController::class, 'update'])->name('update');
});

Route::get('student/api', [StudentController::class, 'api'])->name('students.api');
