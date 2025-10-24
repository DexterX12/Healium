<?php

/*
* Author: Darieth
*/

namespace App\Providers;

use App\Models\Item;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class CartViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {

        View::composer('*', function ($view) {
            $viewProviderData = [];
            $cartItemIds = session('cart_item_data', []);
            $cartItems = Item::whereIn('id', $cartItemIds)->with('drug')->get();
            $viewProviderData['cart_items'] = $cartItems;

            $view->with('viewProviderData', $viewProviderData);
        });
    }
}
