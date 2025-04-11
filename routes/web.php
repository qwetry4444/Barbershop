<?php

use App\Http\Controllers\ServiceController;
use App\Http\Controllers\VisitController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', function () {
    return view('hello', ['title' => "Мишкин Максим 609-22 Настройка окружения и создание проекта"]);
});

Route::get('services', [ServiceController::class, 'index']);

Route::get('service/{id}', [ServiceController::class, 'show']);

Route::get('visits', [VisitController::class, 'index']);

Route::get('visit/create', [VisitController::class, 'create']);
Route::get('visit/edit/{id}', [VisitController::class, 'edit']);
Route::post('visit/update/{id}', [VisitController::class, 'update']);
Route::get('visit/destroy/{id}', [VisitController::class, 'destroy']);
Route::get('visit/{id}', [VisitController::class, 'show']);
Route::post('visit', [VisitController::class, 'store']);




