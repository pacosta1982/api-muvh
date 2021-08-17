<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\AuthController;
//use App\Http\Controllers\API\PagosController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::post('login', [AuthController::class, 'signin']);
Route::post('register', [AuthController::class, 'signup']);

Route::middleware('auth:sanctum')->group(function () {
    //Route::resource('pagos', PagosController::class);
    Route::get('cuotas/{cedula?}', 'App\Http\Controllers\API\PagosController@index');
    Route::post('pagocuota', 'App\Http\Controllers\API\PagosController@pagoCuota');
    Route::post('reversa', 'App\Http\Controllers\API\PagosController@reversaCuota');
});
