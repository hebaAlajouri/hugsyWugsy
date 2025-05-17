<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminOrderItemController extends Controller
{
    public function index()
    {
        $orderItems = OrderItem::with('order', 'product')->get();
        return view('admin.order_items.index', compact('orderItems'));
    }

    public function create()
    {
        $orders = \App\Models\Order::all();
        $products = \App\Models\Product::all();
        return view('admin.order_items.create', compact('orders', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        OrderItem::create($request->all());
        return redirect()->route('admin.order_items.index')->with('success', 'Order item created!');
    }

    public function edit(OrderItem $order_item)
    {
        $orders = \App\Models\Order::all();
        $products = \App\Models\Product::all();
        return view('admin.order_items.edit', compact('order_item', 'orders', 'products'));
    }

    public function update(Request $request, OrderItem $order_item)
    {
        $request->validate([
            'order_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        $order_item->update($request->all());
        return redirect()->route('admin.order_items.index')->with('success', 'Order item updated!');
    }

    public function destroy(OrderItem $order_item)
    {
        $order_item->delete();
        return redirect()->route('admin.order_items.index')->with('success', 'Order item deleted!');
    }
}
