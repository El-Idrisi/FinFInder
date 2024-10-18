<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function settings()
    {
        $user = Auth::user();
        return view('dashboard.profile.settings', ['title' => 'FinFinder | Settings'], compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $rules = [
            'nama' => 'nullable|string|max:255',
            'no_telp' => 'nullable|string|max:20',
            'tanggal_lahir' => 'nullable|date',
            'alamat' => 'nullable|string|max:255',
        ];

        if ($request->input('username') != $user->username) {
            $rules['username'] = 'required|string|max:120|unique:users';
        }

        $validated = $request->validate($rules);

        $user->update($validated);

        return redirect()->back()->with('success', 'Profile Berhasil di Update');
    }
}
