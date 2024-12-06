<?php

namespace App\Http\Controllers;

use App\Mail\VerificationCodeMail;
use App\Models\SpotIkan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $allSpots = SpotIkan::all()->count();
        $kontribusi = SpotIkan::where('dibuat_oleh', Auth::id())->count();
        $allVerified = SpotIkan::where('status', 'disetujui')
            ->where('dibuat_oleh', Auth::id())
            ->count();

        $allRejected = SpotIkan::where('status', 'ditolak')
            ->where('dibuat_oleh', Auth::id())
            ->count();

        $allVerif = SpotIkan::where('status', 'disetujui')
            ->where('diverifikasi_oleh', Auth::id())
            ->count();

        $allReject = SpotIkan::where('status', 'ditolak')
            ->where('diverifikasi_oleh', Auth::id())
            ->count();

        return view('dashboard.profile.index', ['title' => 'FinFinder | Profile'], compact('user', 'allSpots', 'kontribusi', 'allVerified', 'allRejected', 'allVerif', 'allReject'));
    }
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

    public function sendVerificationCode(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'email_baru' => 'required|email|unique:users,email'
        ]);

        if (!Hash::check($request->password, auth()->user()->password)) {
            return response()->json(['message' => 'Password salah'], 422);
        }

        $code = Str::random(6);

        // Simpan kode di session atau database
        session(['email_change_code' => $code]);
        session(['email_baru' => $request->email_baru]);

        // Kirim email dengan kode
        Mail::to($request->email_baru)->send(new VerificationCodeMail($code));

        return response()->json(['message' => 'Kode verifikasi telah dikirim']);
    }

    public function verifyEmailChange(Request $request)
    {
        $request->validate([
            'verification_code' => 'required',
            'email_baru' => 'required|email'
        ]);

        if (
            $request->verification_code !== session('email_change_code') ||
            $request->email_baru !== session('email_baru')
        ) {
            return response()->json(['message' => 'Kode verifikasi salah atau email tidak cocok'], 422);
        }

        $user = auth()->user();
        $user->email = $request->email_baru;
        $user->save();

        session()->forget(['email_change_code', 'email_baru']);

        return response()->json(['message' => 'Email berhasil diubah']);
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'password_sekarang' => ['required', function ($attribute, $value, $fail) {
                if (!Hash::check($value, Auth::user()->password)) {
                    $fail('Password saat ini tidak benar.');
                }
            }],
            'password_baru' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = Auth::user();
        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json(['message' => 'Password berhasil diubah'], 200);
    }

    public function deleteAccount(Request $request)
    {
        $request->validate([
            'password' => 'required',
        ]);

        $user = Auth::user();

        try {
            // Validasi password
            if (!Hash::check($request->password, $user->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Password yang Anda masukkan salah.'
                ], 403);
            }

            // Cek apakah user masih memiliki spot ikan
            if ($user->owner()->exists()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tidak dapat menghapus akun karena masih memiliki data spot ikan terkait.'
                ], 409);
            }

            // Proses penghapusan akun
            $user->delete();
            Auth::logout();

            return response()->json([
                'success' => true,
                'message' => 'Akun Anda telah berhasil dihapus.'
            ]);
        } catch (\Illuminate\Database\QueryException $e) {
            // Tangkap error database
            dd($e->getCode());
            if ($e->getCode() === '23000') {
                return response()->json([
                    'success' => false,
                    'message' => 'Tidak dapat menghapus akun karena masih terkait dengan data lain.'
                ], 409);
            }

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan pada database.'
            ], 500);
        }
    }
}
