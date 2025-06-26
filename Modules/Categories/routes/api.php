<?php

use Illuminate\Support\Facades\Route;
use Modules\Categories\Http\Controllers\CategoryController;

Route::prefix('v1')->group(function () {
    Route::apiResource('categories', CategoryController::class)->names('categories');
});
