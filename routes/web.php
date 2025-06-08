<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\Welcome;

Route::get('/', Welcome::class)->name('welcome')->middleware(['guest']);

// Route::get('/debug-user', function () {
//     $user = \App\Models\User::where('email', 'admin@example.com')->first();
//     dd($user, \Illuminate\Support\Facades\Hash::check('admin123', $user->password));
// });


require __DIR__ . '/dashboard.php';
require __DIR__ . '/auth.php';
