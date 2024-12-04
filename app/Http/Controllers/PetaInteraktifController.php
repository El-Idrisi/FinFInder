<?php

namespace App\Http\Controllers;

use App\Models\FishType;
use App\Models\SpotIkan;
use Illuminate\Http\Request;

class PetaInteraktifController extends Controller
{
    public function index()
    {
        $spots = SpotIkan::where('status', 'disetujui')
            ->get()
            ->map(function($spot) {
                return $spot->getSpotDetail();
            });

        $fishTypes = FishType::all();

        return view('peta-interaktif', [
            'title' => 'FinFinder | Peta Interaktif',
            'spots' => $spots,
            'fishtypes' => $fishTypes,
        ]);
    }
}
