<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;

Route::apiResource('products', ProductController::class);
Route::apiResource('sales', SaleController::class);
