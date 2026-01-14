<?php

use App\Http\Controllers\User\HomeController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('user.home');
Route::get('/faq', [HomeController::class, 'faq'])->name('user.faq');