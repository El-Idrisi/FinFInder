<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\VerificationCode;
use App\Mail\VerificationCodeMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;

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

    public function resendVerificationCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $email = $request->email;

        // Check if the email exists in verification_codes table
        $verificationCode = VerificationCode::where('email', $email)->first();

        if (!$verificationCode) {
            return response()->json([
                'success' => false,
                'message' => 'Email tidak ditemukan dalam sistem verifikasi.'
            ], 404);
        }

        // Implement rate limiting - allow only 3 resend attempts per email every 15 minutes
        $rateLimiterKey = 'resend-verification:' . $email;

        if (RateLimiter::tooManyAttempts($rateLimiterKey, 3)) {
            $seconds = RateLimiter::availableIn($rateLimiterKey);
            return response()->json([
                'success' => false,
                'message' => "Terlalu banyak percobaan. Silakan coba lagi dalam " . ceil($seconds / 60) . " menit."
            ], 429);
        }

        RateLimiter::hit($rateLimiterKey, 900); // 15 minutes = 900 seconds

        // Generate new verification code
        $code = Str::random(6);

        // Update the verification code
        $verificationCode->update([
            'code' => $code,
            'updated_at' => now()
        ]);

        try {
            // Send the new verification code
            Mail::to($email)->send(new VerificationCodeMail($code));

            return response()->json([
                'success' => true,
                'message' => 'Kode verifikasi baru telah dikirim ke email Anda.'
            ]);
        } catch (\Exception $e) {
            report($e); // Log the error
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengirim kode verifikasi. Silakan coba lagi nanti.'
            ], 500);
        }
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
            'username' => 'required|string|alpha_dash|unique:users|min:5',
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
