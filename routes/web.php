<?php

use Illuminate\Support\Facades\Route;

Route::get(uri: '/', action: fn() => response()->json(data: [
    'app' => 'Laravel API Template',
    'php' => PHP_VERSION,
    'framework' => app()->version()
]));
Route::get(uri: '/health', action: fn() => response()->json(['message' => 'OK']));
