<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('mypage.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'username'      => 'required|string|max:255',
            'postal_code'   => 'nullable|string|max:20',
            'address'       => 'nullable|string|max:255',
            'building'      => 'nullable|string|max:255',
            'profile_image' => 'nullable|image|max:2048',
        ]);

        $user->name = $request->username;
        $user->postal_code   = $request->postal_code;
        $user->address       = $request->address;
        $user->building_name = $request->building;

        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('profile_images', 'public');
            $user->profile_image = $path;
        }

        $user->save();

        return redirect()->route('mypage.index');
    }
}
