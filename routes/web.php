<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', [AuthController::class, 'show_signup_form']);

Route::middleware(['token'])->group(function () {
    Route::get('/{personal_link}', [HomeController::class, 'index']);
//    Route::get('/{personal_link}/generate', [HomeController::class, 'generate']);
});
