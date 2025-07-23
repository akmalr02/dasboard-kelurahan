<?php

use App\Livewire\User\Warga\History;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;

Route::get('warga/history', History::class)
    ->middleware(['auth'])
    ->name('warga.history');
