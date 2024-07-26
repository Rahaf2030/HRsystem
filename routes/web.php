<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormSubmissionController;



Route::get('/log', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/log', [LoginController::class, 'login']);
Route::get('/jobApplying', [FormSubmissionController::class, 'form'])->name('jobApplying');
Route::post('/jobApplying', [FormSubmissionController::class, 'submitForm']);


Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::post('/forms/{form}/accept', [DashboardController::class, 'accept'])->name('forms.accept');
Route::post('/forms/{form}/reject', [DashboardController::class, 'reject'])->name('forms.reject');






