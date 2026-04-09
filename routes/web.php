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
Route::post('/store-assessment', [HomeController::class, 'storeAssessmentQuery'])->name('assessment.store');
Route::view('/privacy-policy','user.pages.privacy-policy')->name('privacy-policy');
Route::view('/terms-of-service','user.pages.terms-of-service')->name('terms-of-service');
Route::view('/cookie-policy','user.pages.cookie-policy')->name('cookie-policy');
Route::get('/policy/{slug}', [HomeController::class, 'Policy'])->name('user.policy');
Route::get('/book-assessment/{id}', [HomeController::class, 'BookAssessment'])->name('user.book-assessment');
Route::get('/thank-you', [HomeController::class, 'Thankyou'])->name('user.thankyou');

