<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('pages.checkout');
    }

    public function show()
    {
        $order = Order::with('items.product')
            ->where('user_id', Auth::id())
            ->where('status', 'draft')
            ->firstOrFail();

        return view('checkout.show', compact('order'));
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string|max:255',
            'payment_method' => 'required|in:card,cash',
            'note' => 'nullable|string|max:500',
        ]);

        $order = Order::where('user_id', Auth::id())
            ->where('status', 'draft')
            ->firstOrFail();

        $order->shipping_address = $request->shipping_address;
        $order->payment_method = $request->payment_method;
        $order->note = $request->note;
        $order->status = 'pending';
        $order->total = $order->items->sum(fn($item) => $item->price * $item->quantity);
        $order->save();

        return redirect()->route('cart.confirmation', $order)->with('success', 'Order placed successfully!');
    }
}
