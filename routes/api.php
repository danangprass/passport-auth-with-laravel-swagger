<?php

use App\Http\Controllers\Api\PassportAuthController;
use App\Http\Controllers\CandidateController;
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

Route::controller(PassportAuthController::class)->group(function () {
    Route::post('/login', 'login')->name('login');
    Route::post('/logout', 'logout')->middleware('auth:api')->name('logout');
});
Route::middleware('auth:api')->group(function () {
    Route::get('get-user', [PassportAuthController::class, 'userInfo']);
    Route::controller(CandidateController::class)->prefix('/candidate')->group(function () {
        // code...
        Route::get('', 'index')->name('candidate.list')->middleware('can:candidate.view');
        Route::get('{candidate}', 'show')->name('candidate.detail')->middleware('can:candidate.view');
        Route::post('', 'store')->name('candidate.create')->middleware('can:candidate.create');
        Route::patch('{candidate}', 'update')->name('candidate.update')->middleware('can:candidate.update');
        Route::delete('{candidate}', 'destroy')->name('candidate.delete')->middleware('can:candidate.delete');
    });
});
