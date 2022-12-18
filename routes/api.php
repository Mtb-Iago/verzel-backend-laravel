<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use App\Http\Middleware\ProtectRouteAdminAuth;
use App\Http\Middleware\ProtectRouteAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::get('/vehicle', [VehicleController::class, 'index']);
Route::get('/vehicle/{id}', [VehicleController::class, 'show']);
Route::get('/vehicle/search/{name}', [VehicleController::class, 'search']);

Route::middleware([ProtectRouteAuth::class, ProtectRouteAdminAuth::class])->prefix('admin')->group(function () {
    Route::get('/user', [UserController::class, 'index']);
    Route::post('/user', [UserController::class, 'store'])->withoutMiddleware([ProtectRouteAuth::class, ProtectRouteAdminAuth::class]);

    Route::post('/vehicle', [VehicleController::class, 'store']);
    Route::put('/vehicle/{id}', [VehicleController::class, 'update']);
    Route::delete('/vehicle/{id}', [VehicleController::class, 'destroy']);
});

Route::middleware(ProtectRouteAuth::class)->group(function () {
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
