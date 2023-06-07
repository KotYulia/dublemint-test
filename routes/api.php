<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Rest\GameController;
use App\Http\Controllers\Rest\PersonalLinkController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('register', [AuthController::class, 'process_signup']);
Route::get('/generate', [PersonalLinkController::class, 'generate_link']);
Route::get('/deactivate', [PersonalLinkController::class, 'deactivate_link']);
Route::get('/play', [GameController::class, 'play_game']);
Route::get('/history', [GameController::class, 'last_results']);
