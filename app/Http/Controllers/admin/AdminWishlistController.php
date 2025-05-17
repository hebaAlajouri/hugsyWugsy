<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminWishlistController extends Controller
{
    public function index()
    {
        $wishlist = Wishlist::with(['user', 'product'])->get();
        return view('admin.wishlist.index', compact('wishlist'));
    }

    public function create()
    {
        $users = User::all();
        $products = Product::all();
        return view('admin.wishlist.create', compact('users', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
        ]);

        Wishlist::create($request->all());
        return redirect()->route('admin.wishlist.index');
    }

    public function edit(Wishlist $wishlist)
    {
        $users = User::all();
        $products = Product::all();
        return view('admin.wishlist.edit', compact('wishlist', 'users', 'products'));
    }

    public function update(Request $request, Wishlist $wishlist)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
        ]);

        $wishlist->update($request->all());
        return redirect()->route('admin.wishlist.index');
    }

    public function destroy(Wishlist $wishlist)
    {
        $wishlist->delete();
        return redirect()->route('admin.wishlist.index');
    }
}
