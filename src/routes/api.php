<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AvatarController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::get('/avatar/{name}.webp', [AvatarController::class, 'generate'])->name('avatar.generate');
Route::get('/avatar/{name}', [AvatarController::class, 'generate'])->name('avatar.generate');

Route::get('/avatar.webp', [AvatarController::class, 'generate']);
Route::get('/avatar', [AvatarController::class, 'generate']);
