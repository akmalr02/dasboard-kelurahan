<?php

use App\Livewire\User\RT\DataWargaController as WargaRtController;
use App\Livewire\User\RT\HistoryTtdSurat;
use Illuminate\Support\Facades\Route;


Route::get('/rt/warga', WargaRtController::class)
    ->middleware(['auth'])
    ->name('rt.warga');

Route::get('/rt/history', HistoryTtdSurat::class)
    ->middleware(['auth'])
    ->name('rt.history');
