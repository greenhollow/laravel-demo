<?php

use App\Http\Controllers\HumanController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(HumanController::class)
    ->name('humans.')
    ->prefix('humans')
    ->group(function () {
        Route::get('', 'index')->name('read_all');
        Route::get('/{human}', 'show')->name('read');
        Route::post('', 'store')->name('create');
        Route::patch('/{human}', 'update')->name('update');
        Route::delete('/{human}', 'destroy')->name('destroy');
    })
;
