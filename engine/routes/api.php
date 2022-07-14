<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\HistoryController;
use App\Http\Controllers\Api\TopUpController;
use App\Http\Controllers\Api\TransferController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('login', LoginController::class);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::resource('register', RegisterController::class);

Route::middleware('auth:sanctum')->group(function () {

    Route::resource('top-up', TopUpController::class);
    Route::resource('history', HistoryController::class);
    Route::resource('transfer', TransferController::class);
});
