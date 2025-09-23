<?php

namespace App\Http\Controllers;

use App\Models\Drug;
use App\Models\Item;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(int $drug_id, Request $request): RedirectResponse
    {

        $drugToFind = Drug::findOrFail($drug_id);
        $quantity = $request->input('quantity');
        $total = $drugToFind->getPrice() * $quantity;

        $this->addOrUpdateItemInCart($drugToFind, $quantity, $total, $request);

        return back()->with('success', 'Item added to cart');
    }

    private function addOrUpdateItemInCart(Drug $drug, int $quantity, int $total, Request $request): void
    {
        $cartItemIds = $request->session()->get('cart_item_data', []);

        $itemsInCart = Item::whereIn('id', $cartItemIds)->get();

        $existingItem = $itemsInCart->firstWhere('drug_id', $drug->getId());

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

            $itemDataValidated = Item::validate($itemData);
            $itemToCreate = Item::create($itemDataValidated);
            $cartItemIds[] = $itemToCreate->getId();
            $request->session()->put('cart_item_data', $cartItemIds);
        }
    }

    public function removeAll(Request $request): RedirectResponse
    {
        $request->session()->forget('cart_item_data');

        return back()->with('success', 'Cart cleared');
    }
}
