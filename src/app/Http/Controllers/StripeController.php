<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class StripeController extends Controller
{
    // 決済画面表示
    public function index(Request $request)
    {
        $item = Item::findOrFail($request->item_id);

        return view('stripe.index', compact('item'));
    }

    // 決済処理
    public function charge(Request $request)
    {

        $request->validate([
        'amount' => 'required|integer|min:1',
    ]);

        Stripe::setApiKey(config('services.stripe.secret'));

        PaymentIntent::create([
            'amount' => $request->amount,
            'currency' => 'jpy',
            'payment_method' => $request->payment_method,
            'confirm' => true,
        ]);

        return redirect('/stripe/success');
    }
    //成功画面
    public function success()
    {
        return view('stripe.success');
    }
}