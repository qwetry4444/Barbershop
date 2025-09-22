<?php

use App\Http\Controllers\BarberController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\VisitController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('login', [LoginController::class, 'login'])->name('login');
Route::get('logout', [LoginController::class, 'logout']);
Route::post('auth', [LoginController::class, 'authenticate']);

Route::get('/hello', function () {
    return view('hello', ['title' => "Мишкин Максим 609-22 Настройка окружения и создание проекта"]);
});

Route::get('/barbers',  [BarberController::class, 'index'])->middleware('auth');

Route::get('services', [ServiceController::class, 'index']);
Route::get('pick_date/{barber_id}', [CalendarController::class, 'index']);

Route::get('service/{id}', [ServiceController::class, 'show'])->middleware('auth');
Route::get('barber/{barber_id}/visits_dates', [CalendarController::class, 'json']);
Route::get('barber/{barber_id}/visit_times', [CalendarController::class, 'visitsOnDate']);

Route::get('visits', [VisitController::class, 'index']);

Route::get('booking/barber', [BookingController::class, 'chooseBarber'])->middleware('auth');;
Route::post('booking/barber', [BookingController::class, 'postBarber'])->middleware('auth');;

Route::get('booking/service', [BookingController::class, 'chooseService'])->middleware('auth');;
Route::post('booking/service', [BookingController::class, 'postService'])->middleware('auth');;

Route::get('booking/time', [BookingController::class, 'chooseTime'])->middleware('auth');;
Route::post('booking/time', [BookingController::class, 'postTime'])->middleware('auth');;
//Route::post('visit/{visit_id}/book', [BookingController::class, 'postTime']);

Route::get('booking/confirm', [BookingController::class, 'confirm']);
Route::post('booking/confirm', [BookingController::class, 'postConfirm']);

Route::get('visit/create', [VisitController::class, 'create']);
Route::get('visit/edit/{id}', [VisitController::class, 'edit']);
Route::post('visit/update/{id}', [VisitController::class, 'update']);
Route::get('visit/destroy/{id}', [VisitController::class, 'destroy']);
Route::get('visit/{id}', [VisitController::class, 'show']);
Route::post('visit', [VisitController::class, 'store']);

Route::get('error', function () {
    return view('error', ['message' => session('message')]);
});


