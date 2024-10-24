<?php

namespace App\Http\Controllers;

use App\Models\SpotIkan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index() {
        $allUsers = User::all()->count();
        $allSpots = SpotIkan::where('status', 'disetujui')->count();
        $kontribusi = SpotIkan::where('dibuat_oleh', Auth::id())->count();
        $allVerif = SpotIkan::where('status', 'disetujui')
        ->where('dibuat_oleh', Auth::id())
        ->count();
        return view('dashboard.index', ['title' => 'FinFinder | Dashboard',], compact('allUsers', 'allSpots', 'allVerif', 'kontribusi'));
    }
}
