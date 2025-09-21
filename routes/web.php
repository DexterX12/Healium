<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\HomeController@index')
    ->name('home.index');

Route::get('drug/index', 'App\Http\Controllers\DrugController@index')
    ->name('drug.index');

Route::get('drug/show/{id}', 'App\Http\Controllers\DrugController@show')
    ->name('drug.show');

Route::get('supplier/save', 'App\Http\Controllers\SupplierController@save')
    ->name('supplier.save');

Route::get('supplier/create', 'App\Http\Controllers\SupplierController@create')
    ->name('supplier.create');

Route::get('supplier/show', 'App\Http\Controllers\SupplierController@show')
    ->name('supplier.show/{id}');

Route::get('supplier/index', 'App\Http\Controllers\SupplierController@index')
    ->name('supplier.index');

Route::get('admin/index', 'App\Http\Controllers\Admin\AdminHomeController@index')
    ->name('admin.home.index');

Route::get('admin/drug/index', 'App\Http\Controllers\Admin\AdminDrugController@index')
    ->name('admin.drug.index');

Route::get('admin/drug/show/{id}', 'App\Http\Controllers\Admin\AdminDrugController@index')
    ->name('admin.drug.show');

Route::get('admin/drug/create', 'App\Http\Controllers\Admin\AdminDrugController@create')
    ->name('admin.drug.create');

Route::put('admin/drug/save', 'App\Http\Controllers\Admin\AdminDrugController@save')
    ->name('admin.drug.save');