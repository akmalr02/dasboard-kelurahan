<?php

use App\Livewire\User\RT\DataWargaController as WargaRtController;
use Illuminate\Support\Facades\Route;


Route::get('/rt/warga', WargaRtController::class)
    ->middleware(['auth'])
    ->name('rt.warga');
