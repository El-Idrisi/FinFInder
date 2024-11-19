<?php

namespace App\Http\Controllers;

use App\Models\FishType;
use App\Models\SpotIkan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FishSpotController extends Controller
{
    public function index() {
        $fishdatas = SpotIkan::where('status', 'disetujui')
        ->orderBy('status', 'asc')
        ->orderBy('created_at', 'desc')
        ->get();

        return view('dashboard.tables.data-ikan', ['title' => 'FinFinder | All Fish Spots', 'fishdatas' => $fishdatas]);
    }

    public function show(SpotIkan $spotIkan) {
        return view('dashboard.tables.preview-data', ['title' => 'FinFinder | Show Data', 'spotIkan' => $spotIkan]);
    }

}
