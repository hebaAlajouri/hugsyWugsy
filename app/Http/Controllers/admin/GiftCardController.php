<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GiftCard;
use Illuminate\Http\Request;

class GiftCardController extends Controller
{
    public function index()
    {
        $giftCards = GiftCard::latest()->get();
        return view('admin.gift_cards.index', compact('giftCards'));
    }

    public function create()
    {
        return view('admin.gift_cards.create');
    }

    public function store(Request $request)
    {
        GiftCard::create($request->all());
        return redirect()->route('admin.gift_cards.index')->with('success', 'Gift Card created successfully.');
    }

    public function edit(GiftCard $giftCard)
    {
        return view('admin.gift_cards.edit', compact('giftCard'));
    }

    public function update(Request $request, GiftCard $giftCard)
    {
        $giftCard->update($request->all());
        return redirect()->route('admin.gift_cards.index')->with('success', 'Gift Card updated successfully.');
    }

    public function destroy(GiftCard $giftCard)
    {
        $giftCard->delete();
        return redirect()->route('admin.gift_cards.index')->with('success', 'Gift Card deleted successfully.');
    }
}
