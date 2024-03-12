<?php

use App\Http\Controllers\CourseController;
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

Route::resource('courses', CourseController::class)->except([
    'show',
]);

// viết sau sẽ ghi đè lên thằng viết trước
Route::get('courses/api', [CourseController::class, 'api'])->name('courses.api');

////
//Route::get('test', function(){
//    return view('layout.master');
//});
