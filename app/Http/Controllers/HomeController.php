<?php

/*
* Author: Darieth
*/

namespace App\Http\Controllers;

use App\Models\Drug;
use App\Models\Item;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {

        $cartItemIds = session('cart_item_data', []);
        $cartItems = Item::whereIn('id', $cartItemIds)->with('drug')->get();

        $viewData = [];
        $viewData['drugs'] = Drug::orderBy('created_at', 'desc')->get();
        $viewData['cart_items'] = $cartItems;

        return view('home.index')->with('viewData', $viewData);
    }
}
