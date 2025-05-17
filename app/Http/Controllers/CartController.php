<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Customization;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // View cart
    public function index()
    {
        $order = Order::with('items.product', 'items.customization')
            ->where('user_id', Auth::id())
            ->where('status', 'draft')
            ->first();

        return view('cart.index', compact('order'));
    }

    // Add product to cart
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $userId = Auth::id();
        $productId = $request->product_id;

        $product = Product::findOrFail($productId);

        // Find or create draft order
        $order = Order::firstOrCreate(
            ['user_id' => $userId, 'status' => 'draft'],
            ['total' => 0]
        );

        // Get latest customization for the user and product
        $latestCustomization = Customization::where('user_id', $userId)
            ->where('product_id', $productId)
            ->latest()
            ->first();

        $customizationId = $latestCustomization ? $latestCustomization->id : null;

        // Check if item already exists in cart
        $item = $order->items()->where('product_id', $productId)->first();

        if ($item) {
            $item->quantity += $request->quantity;
            // Always update with the latest customization
            $item->customization_id = $customizationId;
            $item->save();
        } else {
            $order->items()->create([
                'product_id' => $productId,
                'price' => $product->price,
                'quantity' => $request->quantity,
                'customization_id' => $customizationId,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Product added to cart.');
    }

    // Clear cart
    public function clear()
    {
        $order = Order::where('user_id', Auth::id())
            ->where('status', 'draft')
            ->first();

        if ($order) {
            $order->items()->delete();
        }

        return redirect()->route('cart.index')->with('success', 'Cart cleared.');
    }

    // Checkout
    public function checkout()
    {
        $order = Order::with(['items.product', 'items.customization'])
            ->where('user_id', Auth::id())
            ->where('status', 'draft')
            ->first();

        if (!$order || $order->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $order->total = $order->items->sum(fn($item) => $item->price * $item->quantity);
        $order->status = 'pending';
        $order->save();

        return redirect()->route('checkout.show', $order->id)->with('success', 'Order placed successfully!');
    }

    // Remove item from cart
    public function remove($id)
    {
        $item = OrderItem::findOrFail($id);

        $order = Order::where('id', $item->order_id)
            ->where('user_id', Auth::id())
            ->where('status', 'draft')
            ->first();

        if ($order) {
            $item->delete();
            return redirect()->route('cart.index')->with('success', 'Item removed.');
        }

        return redirect()->route('cart.index')->with('error', 'Unauthorized action.');
    }

    // Show checkout form
    public function showCheckoutForm()
    {
        $order = Order::with(['items.product', 'items.customization'])
            ->where('user_id', Auth::id())
            ->where('status', 'draft')
            ->first();

        if (!$order || $order->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        return view('checkout.form', compact('order'));
    }

    // Handle order submission
    public function placeOrder(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string|max:255',
            'note' => 'nullable|string|max:500',
        ]);

        $order = Order::with('items.customization')
            ->where('user_id', Auth::id())
            ->where('status', 'draft')
            ->first();

        if (!$order || $order->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        // Update any items that don't have customization with the latest one
        foreach ($order->items as $item) {
            if (!$item->customization_id) {
                $latestCustomization = Customization::where('user_id', Auth::id())
                    ->where('product_id', $item->product_id)
                    ->latest()
                    ->first();
                
                if ($latestCustomization) {
                    $item->customization_id = $latestCustomization->id;
                    $item->save();
                }
            }
        }

        $order->shipping_address = $request->shipping_address;
        $order->note = $request->note;
        $order->status = 'pending';
        $order->total = $order->items->sum(fn($item) => $item->price * $item->quantity);
        $order->save();

        return redirect()->route('cart.confirmation', ['order' => $order->id])
        ->with('success', '🎉 Order placed successfully!');
    
    }
}