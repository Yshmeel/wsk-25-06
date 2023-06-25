<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/v1/profile', [\App\Http\Controllers\MemberAPIController::class, 'register']);
Route::post('/v1/login', [\App\Http\Controllers\MemberAPIController::class, 'login']);

Route::middleware('api_token')->group(function() {
    Route::post('/v1/logout', [\App\Http\Controllers\MemberAPIController::class, 'logout']);
    Route::get('/v1/courses', [\App\Http\Controllers\MemberAPIController::class, 'courses']);
    Route::post('/v1/registrations', [\App\Http\Controllers\MemberAPIController::class, 'registration']);
    Route::get('/v1/registrations', [\App\Http\Controllers\MemberAPIController::class, 'viewRegistrations']);
    Route::put('/v1/registrations/{id}', [\App\Http\Controllers\MemberAPIController::class, 'rate']);
});
