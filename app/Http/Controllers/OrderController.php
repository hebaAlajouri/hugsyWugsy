<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Create order and add items from session cart
    public function createFromCart()
    {
        $user = Auth::user();
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('products.index')->with('error', 'Your cart is empty.');
        }

        // Step 1: Create a new order
        $order = Order::create([
            'user_id' => $user->id,
            'status' => 'pending',
            'total' => 0,
        ]);

        $total = 0;

        // Step 2: Loop through cart and add items
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'customization_id' => $item['customization_id'] ?? null, // must exist in your order_items table
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);

            $total += $item['price'] * $item['quantity'];
        }

        // Step 3: Update order total
        $order->update(['total' => $total]);

        // Step 4: Clear cart
        session()->forget('cart');

        return redirect()->route('orders.info', ['order' => $order->id])
                         ->with('success', 'Order created. Please enter your details.');
    }

    // Show order items page after adding items
    public function show(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        return view('orders.info', compact('order'));
    }

    // Show the order information form
    public function showInfoForm($orderId)
    {
        $order = Order::findOrFail($orderId);

        if ($order->user_id !== Auth::id()) {
            return redirect()->route('products.index')->with('error', 'Unauthorized access.');
        }

        return view('orders.info', compact('order'));
    }

    // Store the order information
    public function storeInfo(Request $request, $orderId)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'payment_method' => 'required|string|max:50',
            'total' => 'required|numeric|min:0',
        ]);

        $order = Order::findOrFail($orderId);
        $order->update($validated);

        return redirect()->route('order.showSummary', ['order' => $order->id])
                         ->with('success', 'Your order information has been saved.');
    }

    // Show the order summary
    public function showSummary(Order $order)
    {
        return view('orders.summary', compact('order'));
    }

    // Show the checkout page
    public function checkout(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            return redirect()->route('home')->with('error', 'Unauthorized access');
        }

        return view('orders.checkout', compact('order'));
    }
}
