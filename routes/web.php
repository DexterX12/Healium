<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\HomeController@index')
    ->name('home.index');

Route::get('drug.index', 'App\Http\Controllers\DrugController@index')
    ->name('drug.index');

Route::get('drug.create', 'App\Http\Controllers\DrugController@create')
    ->name('drug.create');

Route::get('drug.show/{id}', 'App\Http\Controllers\DrugController@show')
    ->name('drug.view');

Route::get('supplier.save', 'App\Http\Controllers\SupplierController@save')
    ->name('supplier.save');

Route::get('supplier.create', 'App\Http\Controllers\SupplierController@create')
    ->name('supplier.create');

Route::get('supplier.show', 'App\Http\Controllers\SupplierController@show')
    ->name('supplier.show');

Route::get('supplier.index', 'App\Http\Controllers\SupplierController@index')
    ->name('supplier.index');
