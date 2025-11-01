<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ServiceControllerApi;
use App\Http\Controllers\UserControllerApi;
use App\Http\Controllers\VisitControllerApi;
use App\Http\Controllers\BarberControllerApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::get('/services', [ServiceControllerApi::class, 'index']);
Route::get('/service/{id}', [ServiceControllerApi::class, 'show']);
Route::get('/services/total', [ServiceControllerApi::class, 'total']);

Route::get('/barbers', [BarberControllerApi::class, 'index']);
Route::get('/barbers/total', [BarberControllerApi::class, 'total']);


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/visit', [VisitControllerApi::class, 'index']);
    Route::get('/visit/{id}', [VisitControllerApi::class, 'show']);
    Route::get('/user/{id}', [UserControllerApi::class, 'show']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('logout', [AuthController::class, 'logout']);
});

