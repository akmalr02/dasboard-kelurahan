<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\User\Admin\DataUserController;
use App\Livewire\User\Admin\HistoriSurat;

Route::get('/admin/user', DataUserController::class)
    ->middleware(['auth'])
    ->name('admin.index');

Route::get('/admin/history-surat', HistoriSurat::class)
    ->middleware(['auth'])
    ->name('admin.history');
