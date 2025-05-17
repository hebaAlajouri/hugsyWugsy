<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function customizer(Product $product)
    {
        return view('pages.customizer', compact('product'));
    }
}
