<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Welcome;
use App\Http\Controllers\ExportSuratController;

Route::get('/test-laravel', function () {
    return 'Laravel works - ' . now();
});

Route::get('/', Welcome::class)->name('welcome')->middleware(['guest']);

Route::get('/surat/kelahiran/{id}/download', [ExportSuratController::class, 'downloadKelahiran'])
    ->name('kelahiran.download');

require __DIR__ . '/dashboard.php';
require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/rw.php';
require __DIR__ . '/rt.php';
require __DIR__ . '/surat.php';
