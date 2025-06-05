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
Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('login');
})->name('logout');

// Halaman dashboard berdasarkan role - hanya jika login
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', AdminIndexController::class)
        ->name('admin.dashboard');

    Route::get('/warga/dashboard', WargaIndexController::class)
        ->name('warga.dashboard');

    Route::get('/rt/dashboard', RtIndexController::class)
        ->name('rt.dashboard');

    Route::get('/rw/dashboard', RwIndexController::class)
        ->name('rw.dashboard');

    Route::get('/dashboard', function () {
        $user = Auth::user();

        return match ($user->role) {
            'admin' => redirect()->route('admin.dashboard'),
            'warga' => redirect()->route('warga.dashboard'),
            'rt', 'pengelola_rt' => redirect()->route('rt.dashboard'),
            'rw', 'pengelola_rw' => redirect()->route('rw.dashboard'),
            default => redirect()->route('login')
        };
    })->name('dashboard');
});
