<?php

use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiceControllerApi;
use App\Http\Controllers\UserControllerApi;
use App\Http\Controllers\VisitControllerApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::get('/visit', [VisitControllerApi::class, 'index']);
Route::get('/visit/{id}', [VisitControllerApi::class, 'show']);
Route::get('/service', [ServiceControllerApi::class, 'index']);
Route::get('/service/{id}', [ServiceControllerApi::class, 'show']);
Route::get('/user', [UserControllerApi::class, 'index']);
Route::get('/user/{id}', [UserControllerApi::class, 'show']);
