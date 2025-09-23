<?php

/*
* Author: Darieth
*/

namespace App\Http\Controllers;

use App\Models\Drug;
use App\Models\Item;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $viewData = [];
        $viewData['orders'] = Order::where('user_id', auth()->id())->get();

        return view('order.index')->with('viewData', $viewData);
    }

    public function show(int $id): View|RedirectResponse
    {
        $viewData = [];
        $selectedOrder = Order::where('user_id', auth()->id())
            ->with('items.drug')
            ->find($id);

        if (! $selectedOrder)
        {
            return back()->with('fail', __('Order not found'));
        }
        $viewData['order'] = $selectedOrder;
        $viewData['items'] = $selectedOrder->items;

        return view('order.show')->with('viewData', $viewData);
    }

    public function checkout(Request $request): RedirectResponse
    {
        $cartItemIds = $this->getCartItemsFromSession($request);
        if (empty($cartItemIds))
        {
            return back()->with('fail', __('Your cart is empty.'));
        }

        $cartItems = Item::whereIn('id', $cartItemIds)->with('drug')->get();
        foreach ($cartItems as $item)
        {
            $drugToFind = Drug::findOrFail($item->getDrugId());
            if (! $drugToFind || ! $drugToFind->updateStock($item->getQuantity()))
            {
                return redirect()->back()->with('fail', __('Insufficient stock for one or more products in the cart.'));
            }
        }

        $orderData = $request->only(['description', 'payment']);
        $orderData['user_id'] = auth()->id();

        $orderToCreate = $this->create($orderData);

        $this->assignItemsToOrder($cartItemIds, $orderToCreate->getId());

        $this->clearCart($request);

        return redirect()
            ->route('order.index')
            ->with('success', __('Your order has been purchased successfully!'));
    }

    private function getCartItemsFromSession(Request $request): array
    {
        return $request->session()->get('cart_item_data', []);
    }

    private function assignItemsToOrder(array $cartItemIds, int $orderId): void
    {
        Item::whereIn('id', $cartItemIds)
            ->update(['order_id' => $orderId]);
    }

    private function clearCart(Request $request): void
    {
        $request->session()->forget('cart_item_data');
    }

    public function create(array $data): Order
    {
        $orderDataValidated = Order::validate($data);
        $order = Order::create($orderDataValidated);

        return $order;
    }
}
