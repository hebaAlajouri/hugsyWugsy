<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
        $wishlist = session()->get('wishlist', []);
        
        return view('products.index', compact('products', 'wishlist'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            // Add more validations as needed
        ]);

        Product::create($request->all());

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            // Add more validations as needed
        ]);

        $product->update($request->all());

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully');
    }
    public function showCustomizer()
    {
        return view('customizer'); // Show the customizer page
    }

    public function addToCart(Request $request)
    {
        // Add the product to the cart (you can use session or database)
        // Example:
        session()->push('cart.items', $request->all()); 

        return redirect()->route('customizer')->with('success', 'Item added to cart!');
    }

    public function showVoiceRecord()
    {
        // Show the voice recording page (you should implement this page separately)
        return view('voice-record'); 
    }


// namespace App\Http\Controllers;

// use App\Models\Product;
// use Illuminate\Http\Request;

// class ProductController extends Controller
// {
//     public function index() {
//         $products = Product::all();
//         return view('products.index', compact('products'));
//     }

//     public function create() {
//         return view('products.create');
//     }

//     public function store(Request $request) {
//         Product::create($request->all());
//         return redirect()->route('products.index');
//     }

//     public function edit(Product $product) {
//         return view('products.edit', compact('product'));
//     }

//     public function update(Request $request, Product $product) {
//         $product->update($request->all());
//         return redirect()->route('products.index');
//     }

//     public function destroy(Product $product) {
//         $product->delete();
//         return redirect()->route('products.index');
//     }
// }
public function show($id)
{
    $product = Product::findOrFail($id);
    return view('pages.products.show', compact('product'));
}

}
