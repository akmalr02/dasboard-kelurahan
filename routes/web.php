<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\Welcome;

Route::get('/', Welcome::class)->name('welcome')->middleware(['guest']);

require __DIR__ . '/dashboard.php';
require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
