<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\HomeController@index')
    ->name('home.index');

Route::get('drug/index', 'App\Http\Controllers\DrugController@index')
    ->name('drug.index');

Route::get('drug/create', 'App\Http\Controllers\DrugController@create')
    ->name('drug.create');

Route::get('drug/show/{id}', 'App\Http\Controllers\DrugController@show')
    ->name('drug.view');

Route::get('supplier/save', 'App\Http\Controllers\SupplierController@save')
    ->name('supplier.save');

Route::get('supplier/create', 'App\Http\Controllers\SupplierController@create')
    ->name('supplier.create');

Route::get('supplier/show', 'App\Http\Controllers\SupplierController@show')
    ->name('supplier.show/{id}');

Route::get('supplier/index', 'App\Http\Controllers\SupplierController@index')
    ->name('supplier.index');

Route::get('order/index', 'App\Http\Controllers\OrderController@index')
    ->middleware('auth')
    ->name('order.index');

Route::post('order/save', 'App\Http\Controllers\OrderController@save')
    ->middleware('auth')
    ->name('order.save');

Route::get('order/show/{id}', 'App\Http\Controllers\OrderController@show')
    ->middleware('auth')
    ->name('order.show');

Route::post('comment/save', 'App\Http\Controllers\CommentController@save')
    ->middleware('auth')
    ->name('comment.save');

    Route::delete('order/delete/{id}', 'App\Http\Controllers\OrderController@save')
    ->middleware('auth')
    ->name('order.delete');