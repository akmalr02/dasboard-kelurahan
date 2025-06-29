<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Livewire\User\AuthController;
use App\Livewire\User\RegisterController;
use App\Livewire\User\SettingController;

// Halaman login
Route::get('/login', AuthController::class)->name('login');

//registrasi
Route::get('/register', RegisterController::class)->name('register');

// Logout
Route::get('/logout', function () {
    $authComponent = new \App\Livewire\User\AuthController();
    return $authComponent->logout();
})->name('logout');

//setting
Route::get('/setingg', SettingController::class)
    ->middleware(['auth'])
    ->name('setting');

Route::get('/cek-login', function () {
    if (Auth::check()) {
        return 'Sudah login sebagai: ' . Auth::user()->email;
    } else {
        return 'Belum login';
    }
})->middleware('web');
