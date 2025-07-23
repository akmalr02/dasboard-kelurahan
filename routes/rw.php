<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\User\RW\DataWargaController as WargaRwController;
use App\Livewire\User\RW\HistoryTtdSurat;

Route::get('/rw/warga', WargaRwController::class)
    ->middleware(['auth'])
    ->name('rw.warga');

Route::get('/rw/history', HistoryTtdSurat::class)
    ->middleware(['auth'])
    ->name('rw.history');
