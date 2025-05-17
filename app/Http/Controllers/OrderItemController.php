<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderItem;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderItemController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        // For simplicity, we create a new order each time.
        $order = Order::create([
            'user_id' => Auth::id(),
          


        ]);

        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'customization_id' => $customizationId, // nullable
            'quantity' => $quantity,
            'price' => $product->price,
        ]);
        
           // Redirect to the order information page
    return redirect()->route('order.info', ['order' => $order->id])->with('success', 'Product added to your order!');
    }
}
