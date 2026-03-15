<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Http\Controllers\PurchaseController;

class PurchaseController extends Controller
{
    public function show($id)
    {
        $item = Item::findOrFail($id);
        return view('purchase.show', compact('item'));
    }
}
