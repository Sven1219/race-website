<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;


Route::get('/login/{lang?}', LoginController::class)
                ->middleware('guest')
                ->name('login');

Route::post('/login', [LoginController::class, 'authLogin'])
                ->middleware('guest')
                ->name('auth.login');

Route::post('/logout', [LoginController::class, 'authLogout'])
                ->name('logout');
