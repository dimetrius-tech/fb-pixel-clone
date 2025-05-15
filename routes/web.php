<?php

use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('/pixel-view', function () {
    return Inertia::render('PixelView');
})->name('pixel-view');

Route::get('dashboard', function () {
    $data = array_map(fn($item) => json_decode($item, true), array_merge(Redis::smembers('track_visit'), Redis::smembers('track_subscribe')));
    return Inertia::render('Dashboard', ['userActivitiesCount' => $data]);
})->middleware(['auth', 'verified'])->name('dashboard');



require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
