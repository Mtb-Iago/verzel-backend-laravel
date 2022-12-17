<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\VehicleController;
use App\Http\Middleware\ProtectRouteAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::group([

//     'middleware' => 'api',
//     'prefix' => 'auth'

// ], function ($router) {

//     Route::post('login', 'AuthController@login');
//     Route::post('logout', 'AuthController@logout');
//     Route::post('refresh', 'AuthController@refresh');
//     Route::post('me', 'AuthController@me');

// });

Route::get('/vehicle', [VehicleController::class, 'index']);
Route::get('/vehicle/{id}', [VehicleController::class, 'show']);
Route::get('/vehicle/search/{name}', [VehicleController::class, 'search']);
Route::post('/vehicle', [VehicleController::class, 'store']);
Route::put('/vehicle/{id}', [VehicleController::class, 'update']);
Route::delete('/vehicle/{id}', [VehicleController::class, 'destroy']);

Route::post('/login', [AuthController::class, 'login']);

// Route::middleware(['ProtectRouteAuth'])->group()

Route::post('/me', [AuthController::class, 'me'])->middleware(ProtectRouteAuth::class);
Route::post('/logout', [AuthController::class, 'logout']);
Route::post('/register', [AuthController::class, 'store']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
