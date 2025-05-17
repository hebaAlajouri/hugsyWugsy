<?php

namespace App\Http\Controllers;

use App\Models\GiftCard;
use Illuminate\Http\Request;

class GiftCardController2 extends Controller
{
    public function index() {
        $gift_cards = GiftCard::all();
        return view('gift_cards.index', compact('gift_cards'));
    }

    public function create() {
        return view('gift_cards.create');
    }

    public function store(Request $request) {
        GiftCard::create($request->all());
        return redirect()->route('gift-cards.index');
    }

    public function edit(GiftCard $gift_card) {
        return view('gift_cards.edit', compact('gift_card'));
    }

    public function update(Request $request, GiftCard $gift_card) {
        $gift_card->update($request->all());
        return redirect()->route('gift-cards.index');
    }

    public function destroy(GiftCard $gift_card) {
        $gift_card->delete();
        return redirect()->route('gift-cards.index');
    }
}
