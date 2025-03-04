<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', function () {
    return view('hello', ['title' => "Мишкин Максим 609-22 Настройка окружения и создание проекта"]);
});

Route::get('/barbers', [\App\Http\Controllers\BarberController::class, 'index']);
Route::get('/barber/{id}', [\App\Http\Controllers\BarberController::class, 'show']);
Route::get('/visit_services/{id}', [\App\Http\Controllers\VisitController::class, 'show']);
