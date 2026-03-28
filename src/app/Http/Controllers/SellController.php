<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SellController extends Controller
{
    public function index()
    {
        return view('items.sell');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'description'   => 'required|string',
            'price'         => 'required|integer|min:0',
            'condition'     => 'required|string',
            'product_image' => 'required|image|max:2048',
        ]);

        // 画像保存
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

        // カテゴリ紐付け
        if ($request->has('categories')) {
            $categoryIds = Category::whereIn('name', $request->categories)->pluck('id');
            $item->categories()->attach($categoryIds);
        }

        return redirect()->route('items.index');
    }
}
