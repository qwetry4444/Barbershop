<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', function () {
    return view('hello', ['title' => "Мишкин Максим 609-22 Настройка окружения и создание проекта"]);
});
