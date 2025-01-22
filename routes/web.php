<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('welcome'));

Route::middleware([
    'auth:sanctum',
    config('verbstream.auth_session'),
    'verified',
])->group(function (): void {
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');
});
