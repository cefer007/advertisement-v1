<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\HomeController;
use App\Http\Controllers\dashboard\auth\LoginController;


Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'dashboardAuthCheck'], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});
