<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\site\HomeController;
use App\Http\Controllers\site\auth\RegisterController;
use App\Http\Controllers\site\auth\LoginController;
use App\Http\Controllers\site\Advertisement\CreateController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/create', [CreateController::class, 'index'])->name('create');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');
Route::get('/register-verify/{user_id}', [RegisterController::class, 'verifyIndex'])->name('register.verify');
Route::post('/register-verify/{user_id}', [RegisterController::class, 'verify'])->name('register.verify.submit');
Route::get('/register/refresh-code/{user_id}', [RegisterController::class, 'refreshCode'])->name('refresh.register.code');

Route::get('/login',[LoginController::class, 'index'] )->name('login');
Route::post('/login',[LoginController::class, 'login'] )->name('login.submit');
Route::get('/login-verify/{user_id}',[LoginController::class, 'verifyIndex'] )->name('login.verify');
Route::post('/login-verify/{user_id}',[LoginController::class, 'verifySubmit'] )->name('login.verify.submit');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
