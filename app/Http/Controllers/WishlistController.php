<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function add(Product $product)
    {
        $exists = Wishlist::where('user_id', Auth::id())
                          ->where('product_id', $product->id)
                          ->exists();

        if (!$exists) {
            Wishlist::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id
            ]);
        }

        return redirect()->back()->with('success', 'Added to wishlist!');
    }

    public function index()
    {
        $wishlistItems = Wishlist::with('product')
                            ->where('user_id', Auth::id())
                            ->get();

        return view('wishlist.index', compact('wishlistItems'));
    }

    public function remove(Wishlist $wishlist)
    {
        if ($wishlist->user_id === Auth::id()) {
            $wishlist->delete();
        }

        return redirect()->back()->with('success', 'Removed from wishlist!');
    }
}
