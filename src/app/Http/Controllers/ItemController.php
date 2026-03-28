<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    // おすすめ（未認証でも表示）
    public function index(Request $request)
    {
        $keyword = $request->query('keyword');

        $itemsQuery = Item::query()->with('user');

        // 4. 自分が出品した商品は表示しない（ログイン時のみ）
        if (Auth::check()) {
            $itemsQuery->where('user_id', '!=', Auth::id());
        }

        // 2. 商品名で部分一致検索
        if (!empty($keyword)) {
            $itemsQuery->where('name', 'like', '%' . $keyword . '%');
        }

        $items = $itemsQuery->latest()->get();

        // タブ表示用
        $activeTab = 'recommend';

        return view('items.index', compact('items', 'activeTab', 'keyword'));
    }

    // マイリスト（未認証は何も表示）
    public function mylist(Request $request)
    {
        $keyword = $request->query('keyword');

        $items = collect(); // 未認証なら空

        if (Auth::check()) {
            // likes テーブル（user_id, item_id）想定
            $itemsQuery = Item::query()
                ->with('user')
                ->whereHas('likes', function ($q) {
                    $q->where('user_id', Auth::id());
                });

            // 3. 検索状態をマイリストでも保持（同じ keyword を使う）
            if (!empty($keyword)) {
                $itemsQuery->where('name', 'like', '%' . $keyword . '%');
            }

            $items = $itemsQuery->latest()->get();
        }

        $activeTab = 'mylist';

        return view('items.index', compact('items', 'activeTab', 'keyword'));
    }

    public function show(Item $item)
{
    $item->load(['user', 'categories', 'comments.user', 'likes']);

    $liked = Auth::check()
        ? $item->likes->where('user_id', Auth::id())->isNotEmpty()
        : false;

    return view('items.show', compact('item', 'liked'));
}
}
