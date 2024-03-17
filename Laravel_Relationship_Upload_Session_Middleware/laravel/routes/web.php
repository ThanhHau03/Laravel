<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
use App\Http\Middleware\CheckLoginMiddleware;
use App\Http\Middleware\CheckSuperAdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'processLogin'])->name('process_login');

Route::group([
    'middleware' => CheckLoginMiddleware::class
], function(){
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('courses', CourseController::class)->except([
        'show',
        'destroy',
    ]);
    Route::get('courses/api', [CourseController::class, 'api'])->name('courses.api');
    Route::get('courses/api/name', [CourseController::class, 'apiName'])->name('courses.api.name');

    Route::group(['prefix' => 'students', 'as' => 'students.'], function() {
        Route::get('/', [StudentController::class, 'index'])->name('index');
        Route::get('/create', [StudentController::class, 'create'])->name('create');
        Route::post('/create', [StudentController::class, 'store'])->name('store');
        Route::delete('/destroy/{course}', [StudentController::class, 'destroy'])->name('destroy');
        Route::get('/edit/{course}', [StudentController::class, 'edit'])->name('edit');
        Route::put('/edit/{course}', [StudentController::class, 'update'])->name('update');
    });

    Route::get('student/api', [StudentController::class, 'api'])->name('students.api');

    Route::group([
        'middleware' => CheckSuperAdminMiddleware::class
    ], function(){
        Route::delete('courses/destroy/{course}', [CourseController::class, 'destroy'])->name('courses.destroy');
        Route::delete('students/destroy/{student}', [StudentController::class, 'destroy'])->name('students.destroy');
    });
});


