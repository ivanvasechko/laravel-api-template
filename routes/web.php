<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::get(uri: '/', action: static fn () => response()->json(data: [
    'app' => config(key: 'app.name'),
    'php' => PHP_VERSION,
    'framework' => app()->version()
]));
Route::get(uri: '/health', action: static fn () => response()->json(data: ['message' => 'OK']));
