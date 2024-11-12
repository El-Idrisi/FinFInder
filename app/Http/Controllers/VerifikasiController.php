<?php

namespace App\Http\Controllers;

use App\Models\FishType;
use App\Models\SpotIkan;
use Illuminate\Http\Request;

class VerifikasiController extends Controller
{
    public function index() {
        $spots = SpotIkan::where('status', 'ditunda')
        ->paginate(9);

        $fishTypes = FishType::all();
        return view('dashboard.verifikasi.index', ['title' => 'FinFinder | Verfikasi'], compact('spots', 'fishTypes'));
    }
}
