<?php
namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class PurchaseController extends Controller
{
    public function show($id)
    {
        $item = Item::findOrFail($id);
        $user = Auth::user();
        $postal_code   = session('purchase_postal_code',   $user->postal_code   ?? '');
        $address       = session('purchase_address',       $user->address       ?? '');
        $building_name = session('purchase_building_name', $user->building_name ?? '');

        return view('purchase.show', compact(
            'item', 'postal_code', 'address', 'building_name'
        ));
    }

    public function store(Request $request, $id)
    {
        $item = Item::findOrFail($id);
        $stripePaymentIntentId = 'cash_or_convenience';

        if ($request->payment_method === 'card' && $request->stripe_payment_method_id) {
            Stripe::setApiKey(env('STRIPE_SECRET'));

            $intent = PaymentIntent::create([
                'amount'               => $item->price,
                'currency'             => 'jpy',
                'payment_method'       => $request->stripe_payment_method_id,
                'confirm'              => true,
                'automatic_payment_methods' => [
                    'enabled'          => true,
                    'allow_redirects'  => 'never',
                ],
            ]);
            $stripePaymentIntentId = $intent->id;
        }

        Purchase::create([
            'user_id'                  => Auth::id(),
            'item_id'                  => $item->id,
            'price'                    => $item->price,
            'stripe_payment_intent_id' => $stripePaymentIntentId,
            'postal_code'              => session('purchase_postal_code',   Auth::user()->postal_code   ?? ''),
            'address'                  => session('purchase_address',       Auth::user()->address       ?? ''),
            'building_name'            => session('purchase_building_name', Auth::user()->building_name ?? ''),
        ]);

        $item->update(['is_sold' => true]);
        session()->forget(['purchase_postal_code', 'purchase_address', 'purchase_building_name']);

        return redirect()->route('items.index');
    }

    public function addressEdit($id)
    {
        $item = Item::findOrFail($id);
        $user = Auth::user();
        $postal_code   = session('purchase_postal_code',   $user->postal_code   ?? '');
        $address       = session('purchase_address',       $user->address       ?? '');
        $building_name = session('purchase_building_name', $user->building_name ?? '');

        return view('purchase.address', compact(
            'item', 'postal_code', 'address', 'building_name'
        ));
    }

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
