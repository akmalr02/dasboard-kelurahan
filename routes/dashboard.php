<?php

use App\Livewire\Umum\IndexController;
use Illuminate\Support\Facades\Route;
use App\Livewire\User\Admin\IndexController as AdminIndexController;
use App\Livewire\User\Warga\IndexController as WargaIndexController;
use App\Livewire\User\RT\IndexController as RtIndexController;
use App\Livewire\User\RW\IndexController as RwIndexController;

Route::get('index', IndexController::class)->name('index')->middleware(['guest']);

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
