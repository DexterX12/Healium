<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Drug;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{

    public function add(int $drug_id, Request $request): RedirectResponse
{

    $drug = Drug::findOrFail($drug_id);
    $quantity = $request->input('quantity');
    $total = $drug->getPrice() * $quantity;

    $this->addOrUpdateItemInCart($drug, $quantity, $total, $request);

    return back()->with('success', 'Item added to cart');
}

private function addOrUpdateItemInCart(Drug $drug, int $quantity, int $total, Request $request): void
{
    $cartItemIds = $request->session()->get('cart_item_data', []);

    $items = Item::whereIn('id', $cartItemIds)->get();

    $existingItem = $items->firstWhere('drug_id', $drug->getId());

    if ($existingItem) {
        $existingItem->setQuantity($existingItem->getQuantity() + $quantity);
        $existingItem->setTotal($existingItem->getQuantity() * $drug->getPrice()); 
        $existingItem->save();
    } else {
        $itemData = [
            'drug_id' => $drug->getId(),
            'order_id' => null, 
            'quantity' => $quantity,
            'total' => $total,
        ];
        
        $itemDataValidated=Item::validate($itemData);
        $item = Item::create($itemDataValidated);
        $cartItemIds[] = $item->getId();
        $request->session()->put('cart_item_data', $cartItemIds);
    }
}


    public function removeAll(Request $request): RedirectResponse
    {
        $request->session()->forget('cart_item_data');

        return back()->with('success', 'Cart cleared');
    }
}
