<?php
namespace App\Http\Controllers\Admin;



use App\Http\Controllers\Controller;
use App\Models\Customization;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminCustomizationController extends Controller
{
    public function index()
    {
        $customizations = Customization::with(['user', 'product'])->get();
        return view('admin.customizations.index', compact('customizations'));
    }

    public function create()
    {
        $users = \App\Models\User::all();
        $products = \App\Models\Product::all();
        return view('admin.customizations.create', compact('users', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'product_id' => 'required',
        ]);

        Customization::create($request->all());
        return redirect()->route('admin.customizations.index')->with('success', 'Customization created successfully.');
    }

    public function edit(Customization $customization)
    {
        $users = \App\Models\User::all();
        $products = \App\Models\Product::all();
        return view('admin.customizations.edit', compact('customization', 'users', 'products'));
    }

    public function update(Request $request, Customization $customization)
    {
        $customization->update($request->all());
        return redirect()->route('admin.customizations.index')->with('success', 'Customization updated successfully.');
    }

    public function destroy(Customization $customization)
    {
        $customization->delete();
        return redirect()->route('admin.customizations.index')->with('success', 'Customization deleted.');
    }
}
