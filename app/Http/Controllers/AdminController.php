<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class AdminController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();

        return view('admin.dashboard', compact('totalProducts'));
    }

    public function settings()
    {
        return view('admin.settings');
    }
}
