<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->input('category');
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');
        $search = $request->input('search');

        $query = Product::query();

        if ($category) {
            $query->where('category', $category);
        }

        if ($minPrice) {
            $query->where('price', '>=', $minPrice);
        }

        if ($maxPrice) {
            $query->where('price', '<=', $maxPrice);
        }

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        $products = $query->latest()->get();

        $featuredProducts = Product::where('category', 'featured')->take(4)->get();

        // 👇 This line fixes your issue
        $categories = Product::select('category')->distinct()->pluck('category');

        return view('pages.shop', compact('featuredProducts', 'products', 'categories', 'category'));
    }
}
