<?php

use App\Livewire\Surat\Pengantar\AddPengantarController;
use App\Livewire\Surat\Pengantar\PengantarController;
use App\Livewire\Surat\Pengantar\CreatePengantarController;

use App\Livewire\Surat\Kelahiran\KelahiranController;
use App\Livewire\Surat\Kelahiran\CreateKelahiranController;
use App\Livewire\Surat\Kelahiran\AddKelahiranController;

use App\Livewire\Surat\Kematian\AddKematianController;
use App\Livewire\Surat\Kematian\KematianController;
use App\Livewire\Surat\Kematian\CreateKematianController;

use Illuminate\Support\Facades\Route;

//pengantar
Route::get('/pengantar', PengantarController::class)
    ->middleware(['auth'])
    ->name('pengantar');

Route::get('/create/pengantar', CreatePengantarController::class)
    ->middleware(['auth'])
    ->name('create.pengantar');

Route::get('/add/pengantar', AddPengantarController::class)
    ->middleware(['auth'])
    ->name('add.pengantar');

//kelahiran
Route::get('/kelahiran', KelahiranController::class)
    ->middleware(['auth'])
    ->name('kelahiran');

Route::get('/create/kelahiran', CreateKelahiranController::class)
    ->middleware(['auth'])
    ->name('create.kelahiran');

Route::get('/add/kelahiran', AddKelahiranController::class)
    ->middleware(['auth'])
    ->name('add.kelahiran');

//kematian
Route::get('/kematian', KematianController::class)
    ->middleware(['auth'])
    ->name('kematian');

Route::get('/create/kematian', CreateKematianController::class)
    ->middleware(['auth'])
    ->name('create.kematian');

Route::get('/add/kematian', AddKematianController::class)
    ->middleware(['auth'])
    ->name('add.kematian');
