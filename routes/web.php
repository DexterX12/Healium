<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', 'App\Http\Controllers\HomeController@index')
    ->name('home.index');

Route::get('drug/index', 'App\Http\Controllers\DrugController@index')
    ->name('drug.index');

Route::get('drug/show/{id}', 'App\Http\Controllers\DrugController@show')
    ->name('drug.show');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('admin/index', 'App\Http\Controllers\Admin\AdminHomeController@index')
        ->name('admin.home.index');
    
    Route::get('admin/drug/index', 'App\Http\Controllers\Admin\AdminDrugController@index')
        ->name('admin.drug.index');
    
    Route::get('admin/drug/edit/{id}', 'App\Http\Controllers\Admin\AdminDrugController@edit')
        ->name('admin.drug.edit');
    
    Route::get('admin/drug/create', 'App\Http\Controllers\Admin\AdminDrugController@create')
        ->name('admin.drug.create');
    
    Route::post('admin/drug/save', 'App\Http\Controllers\Admin\AdminDrugController@save')
        ->name('admin.drug.save');
    
    Route::put('admin/drug/update', 'App\Http\Controllers\Admin\AdminDrugController@update')
        ->name('admin.drug.update');
    
    Route::delete('admin/drug/delete', 'App\Http\Controllers\Admin\AdminDrugController@delete')
        ->name('admin.drug.delete');
    
    Route::get('admin/supplier/index', 'App\Http\Controllers\Admin\AdminSupplierController@index')
        ->name('admin.supplier.index');
    
    Route::get('admin/supplier/edit/{id}', 'App\Http\Controllers\Admin\AdminSupplierController@edit')
        ->name('admin.supplier.edit');
    
    Route::get('admin/supplier/create', 'App\Http\Controllers\Admin\AdminSupplierController@create')
        ->name('admin.supplier.create');
    
    Route::post('admin/supplier/save', 'App\Http\Controllers\Admin\AdminSupplierController@save')
        ->name('admin.supplier.save');
    
    Route::put('admin/supplier/update', 'App\Http\Controllers\Admin\AdminSupplierController@update')
        ->name('admin.supplier.update');
    
    Route::delete('admin/supplier/delete', 'App\Http\Controllers\Admin\AdminSupplierController@delete')
        ->name('admin.supplier.delete');
});

Route::middleware('auth')->group(function () {
    Route::get('order/index', 'App\Http\Controllers\OrderController@index')
        ->name('order.index');
    
    Route::post('order/save', 'App\Http\Controllers\OrderController@save')
        ->name('order.save');
    
    Route::get('order/show/{id}', 'App\Http\Controllers\OrderController@show')
        ->name('order.show');
    
    Route::post('cart/add/{id}', 'App\Http\Controllers\CartController@add')
        ->name('cart.add');
    
    Route::delete('cart/removeAll', 'App\Http\Controllers\CartController@removeAll')
        ->name('cart.removeAll');
    
    Route::post('comment/save', 'App\Http\Controllers\CommentController@save')
        ->name('comment.save');
    
    Route::delete('order/delete/{id}', 'App\Http\Controllers\OrderController@save')
        ->name('order.delete');
});

Auth::routes();
