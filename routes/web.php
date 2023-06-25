<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if(!Auth::check()) {
        return redirect('/login');
    }

    return redirect('/courses');
});

// login and logout pages

Route::get('/login', function() {
    return view('login');
});

Route::post('/login', [\App\Http\Controllers\UserController::class, 'postLogin']);

// authorization pages
Route::middleware('auth')->group(function() {
    Route::get('/logout', function() {
        Auth::logout();
        return redirect("/login");
    });

    Route::get('/courses', [\App\Http\Controllers\CoursesController::class, 'courses']);
    Route::get('/courses/new', [\App\Http\Controllers\CoursesController::class, 'newCourse']);
    Route::get('/course/{id}', [\App\Http\Controllers\CoursesController::class, 'editCourse']);
    Route::post('/course/manage', [\App\Http\Controllers\CoursesController::class, 'manageCourse']);
    Route::get('/course/{id}/attendee', [\App\Http\Controllers\CoursesController::class, 'attendeeCourse']);
    Route::get('/course/{id}/diagram', [\App\Http\Controllers\CoursesController::class, 'diagramCourse']);

    Route::get('/members', [\App\Http\Controllers\UserController::class, 'members']);
    Route::get('/member/{id}/toggle', [\App\Http\Controllers\UserController::class, 'toggleMembership']);
});
