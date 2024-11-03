<?php

namespace App\Http\Controllers;

use App\Models\FishType;
use App\Models\SpotIkan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FishSpotController extends Controller
{
    public function showAll() {
        $fishdatas = SpotIkan::where('status', 'disetujui')->get();

        return view('dashboard.tables.data-ikan', ['title' => 'FinFinder | All Fish Spots', 'fishdatas' => $fishdatas]);
    }

    public function showCreate()
    {
        return view('dashboard.tables.create', ['title' => 'FinFinder | Create Fish Spot']);
    }
    public function create(Request $request)
    {
        $request->validate([
            'jenis_ikan' => 'required|array',
            'longitude' => 'required|numeric',
            'latitude' => 'required|numeric',
            'deskripsi' => 'required|string',
        ]);

        $fishTypeIds = [];


        foreach ($request->jenis_ikan as $fishType) {
            if (is_numeric($fishType)) {
                $fishTypeIds[] = $fishType;
            } else {
                $newFishType = FishType::create(['nama' => $fishType]);
                $fishTypeIds[] = "". $newFishType->id;
            }
        }
        $status = 'ditunda';
        if (Auth::user()->role == 'admin')  $status = 'disetujui';

        $spotIkan = SpotIkan::create([
            'tipe_ikan' => json_encode($fishTypeIds),
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
            'deskripsi' => $request->deskripsi,
            'dibuat_oleh' => Auth::id(),
            'status' => $status,
        ]);

        return redirect()->route('data-ikan')->with('success', 'Berhasil Menambahkan Fish Spot Baru');
    }

    public function viewData($id) {
        $spotIkan = SpotIkan::find($id);
        return view('dashboard.tables.preview-data', ['title' => 'FinFinder | Show Data', 'spotIkan' => $spotIkan]);
    }
}
