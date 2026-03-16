<?php
namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    // 商品購入画面を表示
    public function show($id)
    {
        $item = Item::findOrFail($id);

        $user = Auth::user();
        $postal_code   = session('purchase_postal_code',   $user->postal_code   ?? '');
        $address       = session('purchase_address',       $user->address       ?? '');
        $building_name = session('purchase_building_name', $user->building_name ?? '');

        return view('purchase.show', compact(
            'item',
            'postal_code',
            'address',
            'building_name'
        ));
    }

    // 購入を実行して保存
    public function store(Request $request, $id)
    {
        $item = Item::findOrFail($id);

        Purchase::create([
            'user_id'                  => Auth::id(),
            'item_id'                  => $item->id,
            'price'                    => $item->price,
            'stripe_payment_intent_id' => 'cash_or_convenience',
            'postal_code'              => session('purchase_postal_code',  Auth::user()->postal_code  ?? ''),
            'address'                  => session('purchase_address',      Auth::user()->address      ?? ''),
            'building_name'            => session('purchase_building_name', Auth::user()->building_name ?? ''),
        ]);

        // 購入済みフラグを立てる
        $item->update(['is_sold' => true]);

        // セッションを削除
        session()->forget(['purchase_postal_code', 'purchase_address', 'purchase_building_name']);

        return redirect()->route('items.index');
    }

     // 住所変更画面を表示
    public function addressEdit($id)
    {
        $item = Item::findOrFail($id);
        $user = Auth::user();

        $postal_code   = session('purchase_postal_code',   $user->postal_code   ?? '');
        $address       = session('purchase_address',       $user->address       ?? '');
        $building_name = session('purchase_building_name', $user->building_name ?? '');

        return view('purchase.address', compact(
            'item',
            'postal_code',
            'address',
            'building_name'
        ));
    }

    // 住所をセッションに保存して購入画面に戻る
    public function addressUpdate(Request $request, $id)
    {
        $request->validate([
            'postal_code'   => ['required', 'regex:/^\d{3}-\d{4}$/'],
            'address'       => ['required', 'string', 'max:255'],
            'building_name' => ['nullable', 'string', 'max:255'],
        ]);

        session([
            'purchase_postal_code'   => $request->postal_code,
            'purchase_address'       => $request->address,
            'purchase_building_name' => $request->building_name,
        ]);

        return redirect()->route('purchase.show', ['id' => $id]);
    }
}
