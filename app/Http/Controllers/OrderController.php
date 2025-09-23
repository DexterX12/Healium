<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Item;
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

        if (! $selectedOrder) {
            return back()->with('fail', 'Order not found');
        }
        $viewData['order'] = $selectedOrder;
        $viewData['items'] = $selectedOrder->items;
        return view('order.show')->with('viewData', $viewData);
    }

    public function checkout(Request $request): RedirectResponse
    {
        $cartItemIds = $this->getCartItemsFromSession($request);
        if (empty($cartItemIds)) {
            return back()->with('fail', 'Your cart is empty.');
        }

        $orderData = $request->only(['description','payment']);
        $orderData['user_id'] = auth()->id();

        $order = $this->create($orderData);

        $this->assignItemsToOrder($cartItemIds, $order->getId());

        $this->clearCart($request);

        return redirect()
            ->route('order.index')
            ->with('success', 'Your order has been purchased successfully!');
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
