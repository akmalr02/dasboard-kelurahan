<?php

use App\Livewire\Umum\IndexController;
use Illuminate\Support\Facades\Route;

Route::get('index', IndexController::class)->name('index')->middleware(['guest']);
