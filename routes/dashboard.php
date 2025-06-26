<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\HomeController;
use App\Http\Controllers\dashboard\auth\LoginController;
use App\Http\Controllers\dashboard\car\CarQueryController;
use App\Http\Controllers\dashboard\car\CarCommandController;


Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'dashboardAuthCheck'], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::group(['prefix' => 'car', 'as' => 'car.'], function () {
        Route::get('/index' , [CarQueryController::class, 'index'])->name('index');
        Route::get('/create' , [CarQueryController::class, 'create'])->name('create');
        Route::get('/edit/{id}' , [CarQueryController::class, 'edit'])->name('edit');

        Route::post('/store' , [CarCommandController::class, 'store'])->name('store');
        Route::post('/update/{id}' , [CarCommandController::class, 'update'])->name('update');
    });
});
