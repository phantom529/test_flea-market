<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MypageController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $soldItems = $user->items()->latest()->get();
        $boughtItems = $user->purchases()->with('item')->latest()->get()
            ->pluck('item')
            ->filter();

        return view('mypage.index', compact('user', 'soldItems', 'boughtItems'));
    }
}
