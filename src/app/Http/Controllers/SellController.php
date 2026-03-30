<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use App\Http\Requests\ExhibitionRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SellController extends Controller
{
    public function index()
    {
        return view('items.sell');
    }

    public function store(ExhibitionRequest $request)
    {
        $imagePath = $request->file('product_image')->store('items', 'public');

        $item = Item::create([
            'user_id'      => Auth::id(),
            'name'         => $request->name,
            'description'  => $request->description,
            'price'        => $request->price,
            'condition'    => $request->condition,
            'brand_name'   => $request->brand ?? '',
            'items_image'  => Storage::url($imagePath),
            'item_comment' => '',
            'is_sold'      => false,
        ]);

        if ($request->has('categories')) {
            $categoryIds = Category::whereIn('name', $request->categories)->pluck('id');
            $item->categories()->attach($categoryIds);
        }

        return redirect()->route('items.index');
    }
}
