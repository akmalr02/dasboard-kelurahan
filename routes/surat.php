<?php

use App\Livewire\Surat\AddKelahiranController;
use App\Livewire\Surat\AddKematianController;
use App\Livewire\Surat\AddPengantarController;
use Illuminate\Support\Facades\Route;
use App\Livewire\Surat\KematianController;
use App\Livewire\Surat\KelahiranController;
use App\Livewire\Surat\PengantarController;
use App\Livewire\Surat\CreatePengantarController;
use App\Livewire\Surat\CreateKematianController;
use App\Livewire\Surat\CreateKelahiranController;

Route::get('/kelahiran', KelahiranController::class)
    ->middleware(['auth'])
    ->name('kelahiran');

Route::get('/create/kelahiran', CreateKelahiranController::class)
    ->middleware(['auth'])
    ->name('create.kelahiran');

Route::get('/kematian', KematianController::class)
    ->middleware(['auth'])
    ->name('kematian');

Route::get('/create/kematian', CreateKematianController::class)
    ->middleware(['auth'])
    ->name('create.kematian');

Route::get('/pengantar', PengantarController::class)
    ->middleware(['auth'])
    ->name('pengantar');

Route::get('/create/pengantar', CreatePengantarController::class)
    ->middleware(['auth'])
    ->name('create.pengantar');

Route::get('/add/pengantar', AddPengantarController::class)
    ->middleware(['auth'])
    ->name('add.pengantar');

Route::get('/add/kelahiran', AddKelahiranController::class)
    ->middleware(['auth'])
    ->name('add.kelahiran');

Route::get('/add/kematian', AddKematianController::class)
    ->middleware(['auth'])
    ->name('add.kematian');
