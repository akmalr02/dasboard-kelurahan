<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Livewire\User\AuthController;


// Halaman login
Route::get('/login', AuthController::class)->name('login');

// Logout
Route::get('/logout', function () {
    $authComponent = new \App\Livewire\User\AuthController();
    return $authComponent->logout();
})->name('logout');


Route::get('/cek-login', function () {
    if (Auth::check()) {
        return 'Sudah login sebagai: ' . Auth::user()->email;
    } else {
        return 'Belum login';
    }
})->middleware('web');
