<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\User\Admin\DataUserController;

Route::get('/admin/user', DataUserController::class)
    ->middleware(['auth'])
    ->name('admin.index');
