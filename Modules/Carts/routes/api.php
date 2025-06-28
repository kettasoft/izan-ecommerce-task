<?php

use Illuminate\Support\Facades\Route;
use Modules\Carts\Http\Controllers\CartController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('carts', CartController::class)->names('carts');
});
