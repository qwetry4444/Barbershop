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

Route::get('visit/{id}', [VisitController::class, 'show']);
