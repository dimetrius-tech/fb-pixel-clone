<?php

use App\Http\Controllers\PixelController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('/pixel-statistic', [PixelController::class, 'show'])
    ->middleware(['auth', 'verified'])
    ->name('pixel-statistic');

Route::get('/pixel-view', function () {
    return Inertia::render('PixelView');
})->name('pixel-view');

Route::get('/track/pixel.gif', [PixelController::class, 'track']);

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
