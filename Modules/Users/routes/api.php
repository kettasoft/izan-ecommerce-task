<?php

use Illuminate\Support\Facades\Route;
use Modules\Users\Http\Controllers\LogoutController;
use Modules\Users\Http\Controllers\ProfileController;
use Modules\Users\Http\Controllers\Auth\LoginController;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('profile', ProfileController::class)->name('profile');
});

Route::prefix('v1')->group(function () {
    Route::post('login', LoginController::class)->name('login');
    Route::post('logout', LogoutController::class)->name('logout');
});
