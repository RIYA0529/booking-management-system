<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;

Route::get('/', [BookingController::class, 'index']);

Route::post('/bookings', [BookingController::class, 'store'])
    ->name('bookings.store');

Route::put('/bookings/{booking}', [BookingController::class, 'update'])
    ->name('bookings.update');

Route::patch('/bookings/{booking}/confirm', [BookingController::class, 'confirm'])
    ->name('bookings.confirm');

Route::delete('/bookings/{booking}', [BookingController::class, 'destroy'])
    ->name('bookings.destroy');
    