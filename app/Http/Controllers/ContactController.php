<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index () {
        return view('contact' , ['title' => 'FinFinder | Contact Us']);
    }

    public function send(Request $request) {
        $request->validate([
            'nama' =>'required',
            'email' =>'required|email',
            'pesan' =>'required',
        ]);

        $nama = $request->nama;
        $email = $request->email;
        $pesan = $request->pesan;

        // Proses pengiriman email
        Mail::to('finfinder.official@gmail.com')->send(new ContactMail($nama, $email, $pesan));
        // dd('berhasil', $nama, $email, $pesan);

        return redirect()->route('contact')->with('success', 'Your message has been sent successfully!');
    }
}
