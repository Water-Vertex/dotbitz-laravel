<?php

use App\Http\Controllers\User\HomeController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('user.home');
Route::get('/about-us', [HomeController::class, 'about'])->name('user.about');
Route::get('/contact-us', [HomeController::class, 'contact'])->name('user.contact');
Route::post('/contact-us', [HomeController::class, 'storeContact'])->name('contact.store');
Route::get('/faq', [HomeController::class, 'faq'])->name('user.faq');
Route::get('/courses', [HomeController::class, 'courses'])->name('user.courses');
Route::get('/course/{slug}', [HomeController::class, 'courseDetails'])->name('user.course.details');
Route::post('/store-appointment', [HomeController::class, 'storeAppointment'])->name('appointment.store');

