<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function create()
    {
        $users = User::all();
        return view('admin.orders.create', compact('users'));
    }

    public function store(Request $request)
    {
        // Remove 'full_name' from the request to avoid inserting it into the database
        $validated = $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'email' => 'required|email',
            'address' => 'required|string',
            'phone' => 'required|string',
            'payment_method' => 'required|string',
            'total' => 'required|numeric',
        ]);

        // Create the order without the 'full_name'
        Order::create($validated);
        return redirect()->route('admin.orders.index')->with('success', 'Order created successfully.');
    }

    public function edit(Order $order)
    {
        $users = User::all();
        return view('admin.orders.edit', compact('order', 'users'));
    }

    public function update(Request $request, Order $order)
    {
        // Remove 'full_name' from the request to avoid updating it in the database
        $validated = $request->validate([
            'user_id' => 'nullable|exists:users,id',
            'email' => 'required|email',
            'address' => 'required|string',
            'phone' => 'required|string',
            'payment_method' => 'required|string',
            'total' => 'required|numeric',
        ]);

        // Update the order without 'full_name'
        $order->update($validated);
        return redirect()->route('admin.orders.index')->with('success', 'Order updated successfully.');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.orders.index')->with('success', 'Order deleted successfully.');
    }
}
