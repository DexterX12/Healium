<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/drug/{id}', 'App\Http\Controllers\Api\DrugControllerAPI@show')
    ->name('api.drug.show');

Route::get('/supplier', 'App\Http\Controllers\Api\SupplierControllerAPI@index')
    ->name('api.supplier.index');
