<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Item;

class ViewServiceProvider extends ServiceProvider
{

    public function boot(): void
    {

        View::composer('*', function ($view) {
            $viewData = $view->getData()['viewData'] ?? [];
            $cartItemIds = session('cart_item_data', []);
            $cartItems = Item::whereIn('id', $cartItemIds)->with('drug')->get();
            $viewData['cart_items'] = $cartItems;

            $view->with('viewData', $viewData);
        });
    }
}
