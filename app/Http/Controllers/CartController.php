<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(Request $request): View
    {
        $cartItemIds = $request->session()->get('cart_item_data', []);
        $cartItems = Item::whereIn('id', $cartItemIds)->with('drug')->get();

        $viewData = [];
        $viewData['cartItems'] = $cartItems;

        return view('cart.modal')->with('viewData', $viewData);
    }

    public function add(string $itemId, Request $request): RedirectResponse
    {
        $cartItemData = $request->session()->get('cart_item_data', []);
        if (! in_array($itemId, $cartItemData)) {
            $cartItemData[] = $itemId;
        }
        $request->session()->put('cart_item_data', $cartItemData);

        return back()->with('success', 'Item added to cart');
    }

    public function removeAll(Request $request): RedirectResponse
    {
        $request->session()->forget('cart_item_data');

        return back()->with('success', 'Cart cleared');
    }
}
