<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function showLoginForm()
    {
        return view('auth.index', array('title' => 'FinFinder | Login'));
    }

    // Proses login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
            'username' => 'Username atau password yang diberikan tidak sesuai.',
        ]);
        // dd($request->all());
    }

    // Menampilkan halaman register
    public function showRegisterForm()
    {
        return view('auth.register', array('title' => 'FinFinder | Register'));
    }

    // Proses registrasi
    public function register(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'username' => 'required|string|max:255|alpha_dash',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // event(new Registered($user));

        // Redirect ke halaman login atau dashboard setelah registrasi berhasil
        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }
    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
