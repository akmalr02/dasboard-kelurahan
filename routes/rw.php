<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\User\RW\DataWargaController as WargaRwController;


Route::get('/rw/warga', WargaRwController::class)
    ->middleware(['auth'])
    ->name('rw.warga');
