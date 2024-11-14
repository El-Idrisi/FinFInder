<?php

namespace App\Http\Controllers;

use App\Models\FishType;
use App\Models\SpotIkan;
use Illuminate\Http\Request;

class VerifikasiController extends Controller
{
    public function index(Request $request)
    {
        // Query dasar dengan status 'ditunda'
        $query = SpotIkan::where('status', 'ditunda');
        $sort = "desc";
        $count = 9;

        // Tambahkan filter jenis ikan jika ada
        if ($request->has('fish_type') && $request->fish_type !== null) {
            $fishTypeId = $request->fish_type;
            $query->where(function ($q) use ($fishTypeId) {
                // Cek untuk format dengan petik dua ["1","2"]
                $q->whereJsonContains('tipe_ikan', $fishTypeId)
                    // Cek untuk format tanpa petik dua [1,2]
                    ->orWhereRaw('JSON_CONTAINS(tipe_ikan, ?)', [$fishTypeId]);
            });
        }

        switch ($request->date) {
            case 'terbaru':
                $sort = 'desc';
                break;
            case 'terlama':
                $sort = 'asc';
                break;
            default:
                $sort = 'desc';
        }

        switch ($request->count) {
            case '9':
                $count = 9;
                break;
            case '15':
                $count = 15;
                break;
            case '27':
                $count = 27;
                break;
            case '48':
                $count = 48;
                break;
            default:
                $count = 9;
                break;
        }

        // Eksekusi query dengan pagination
        $spots = $query->orderBy('created_at', $sort)->paginate($count);

        // Ambil semua jenis ikan untuk dropdown
        $fishTypes = FishType::all();

        return view('dashboard.verifikasi.index', [
            'title' => 'FinFinder | Verfikasi',
            'spots' => $spots,
            'fishTypes' => $fishTypes
        ]);
    }
}
