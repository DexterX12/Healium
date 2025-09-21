<?php

namespace App\Http\Controllers;

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
        $selectedOrder = Order::where('user_id', auth()->id())->find($id);
        if (!$selectedOrder){
            return back()->with('error', 'Order not found');
        }
        $viewData['order'] = $selectedOrder;

        return view('order.view')->with('viewData', $viewData);
    }

    public function save(Request $request): RedirectResponse
    {
        $orderData = $request->only(['description']);
        $orderData['user_id'] = auth()->id();

        $orderDataValidated = Order::validate($orderData);

        Order::create($orderDataValidated);

        return back()->with('success', 'Order generated successfully');
    }

}
