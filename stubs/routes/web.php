<?php

use App\Http\Livewire\ForgotPassword;
use App\Http\Livewire\Login;
use App\Http\Livewire\Profile;
use App\Http\Livewire\Register;
use App\Http\Livewire\ResetPassword;
use Illuminate\Support\Facades\Route;

Route::view('/home', 'home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', Profile::class)->name('profile');
});

Route::middleware('guest')->group(function () {
    Route::view('/', 'home');
    Route::get('/register', Register::class)->name('register');
    Route::get('/login', Login::class)->name('login');
    Route::get('/forgot-password', ForgotPassword::class)->name('password.forgot');
    Route::get('/reset-password/{token}', ResetPassword::class)->name('password.reset');
});
