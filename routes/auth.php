<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Livewire\User\AuthController;
use App\Livewire\User\Admin\IndexController as AdminIndexController;
use App\Livewire\User\Warga\IndexController as WargaIndexController;
use App\Livewire\User\RT\IndexController as RtIndexController;
use App\Livewire\User\RW\IndexController as RwIndexController;

// Halaman login
Route::get('/login', AuthController::class)->name('login');

// Logout
Route::get('/logout', function () {
    $authComponent = new \App\Livewire\User\AuthController();
    return $authComponent->logout();
})->name('logout');

Route::get('/admin/dashboard', AdminIndexController::class)
    ->middleware(['auth'])
    ->name('admin.dashboard');

Route::get('/warga/dashboard', WargaIndexController::class)
    ->middleware(['auth'])
    ->name('warga.dashboard');

Route::get('/rt/dashboard', RtIndexController::class)
    ->middleware(['auth'])
    ->name('rt.dashboard');

Route::get('/rw/dashboard', RwIndexController::class)
    ->middleware(['auth'])
    ->name('rw.dashboard');
// Auth::check()
Route::get('/cek-login', function () {
    if (Auth::check()) {
        return 'Sudah login sebagai: ' . Auth::user()->email;
    } else {
        return 'Belum login';
    }
})->middleware('web'); // penting!
