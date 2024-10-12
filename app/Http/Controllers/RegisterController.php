<?php

namespace App\Http\Controllers;

use App\Mail\VerificationCodeMail;
use App\Models\User;
use App\Models\VerificationCode;
use GuzzleHttp\Promise\Create;
use Illuminate\Auth\Events\Validated;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function showStep1()
    {
        return view('auth.register.step_1', ['title' => 'FinFinder | Register']);
    }

    public function processStep1(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
        ]);

        $code = Str::random(6);

        VerificationCode::updateOrCreate(
            ['email' => $request->email],
            ['code' => $code]
        );

        // Kirim email dengan kode verifikasi
        Mail::to($request->email)->send(new VerificationCodeMail($code));
        // dd('berhasil', $code);

        return redirect()->route('register.step2', ['email' => $request->email])
            ->with('success', 'Kode verifikasi telah dikirim ke email Anda.');
    }

    public function showStep2($email)
    {
        return view('auth.register.step_2', compact('email'), ['title' => 'FinFinder | Register']);
    }

    public function processStep2(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'verification_code' => 'required',
        ]);

        $verificationCode = VerificationCode::where('email', $request->email)
        ->where('code', $request->verification_code)
        ->first();

        if (!$verificationCode) {
            return back()->withErrors(['verification_code' => 'Kode verifikasi tidak valid.']);
        }

        return redirect()->route('register.step3', ['email' => $request->email]);
    }

    public function showStep3($email)
    {
        return view('auth.register.step_3', compact('email'), ['title' => 'FinFinder | Register']);
    }

    public function processStep3(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
            'username' => 'required|string|alpha_dash|unique:users',
            'password' => 'required|string|confirmed|min:8'
        ]);

        User::create([
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'email_verified_at' => date('Y-m-d H:i:s')
        ]);

        VerificationCode::where('email', $request->email)->delete();

        return redirect()->route('login')->with('success', 'Selamat Anda berhasil Membuat akun baru.');
    }
}
