<?php

namespace App\Http\Controllers;

use App\Models\SpotIkan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $allUsers = User::all()->count();
        $allSpots = SpotIkan::where('status', 'disetujui')->count();
        $kontribusi = SpotIkan::where('dibuat_oleh', Auth::id())->count();
        $allVerified = SpotIkan::where('status', 'disetujui')
            ->where('dibuat_oleh', Auth::id())
            ->count();
        $allVerif = SpotIkan::where('status', 'disetujui')
            ->where('diverifikasi_oleh', Auth::id())
            ->count();

        $currentMonth = now()->startOfMonth();

        $topGlobals = User::withCount([
            'owner' => function ($query) {
                $query->whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year);
            },
            'owner as verified_count' => function ($query) {
                $query->where('status', 'disetujui')
                    ->whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year);
            }
        ])
            ->orderByDesc('verified_count')
            ->orderByDesc('owner_count')
            ->limit(5)
            ->get();

        $activities = SpotIkan::where('status', 'disetujui')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Ambil data 6 bulan terakhir
        $monthlyContributions = SpotIkan::select(
            DB::raw('COUNT(*) as total'),
            DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
            DB::raw('DATE_FORMAT(created_at, "%b") as month_name')
        )
            ->where('created_at', '>=', now()->copy()->subMonths(5)->startOfMonth())
            ->where('created_at', '<=', now()->endOfMonth())
            ->groupBy('month', 'month_name')
            ->orderBy('month')
            ->get();

        // Format data untuk chart
        $labels = [];
        $data = [];

        // Generate 6 bulan terakhir
        for ($i = 5; $i >= 0; $i--) {
            $monthDate = now()->copy()->subMonths($i);
            $monthKey = $monthDate->format('Y-m');
            $monthName = $monthDate->translatedFormat('M'); // Jan, Feb, etc

            // Cari data untuk bulan ini
            $contribution = $monthlyContributions->firstWhere('month', $monthKey);

            $labels[] = $monthName;
            $data[] = $contribution ? $contribution->total : 0;
        }


        return view('dashboard.index', ['title' => 'FinFinder | Dashboard',], compact('allUsers', 'allSpots', 'allVerif', 'kontribusi', 'allVerified', 'topGlobals', 'labels', 'data', 'activities'));
    }
}
