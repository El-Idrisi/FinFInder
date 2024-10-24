<?php

namespace App\Http\Controllers;

use App\Models\FishType;
use App\Models\SpotIkan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FishSpotController extends Controller
{
    public function showAll() {
        $fishdatas = SpotIkan::all();

        return view('dashboard.tables.data-ikan', ['title' => 'FinFinder | All Fish Spots', 'fishdatas' => $fishdatas]);
    }

    public function showCreate()
    {
        $fishtype = FishType::all();
        return view('dashboard.tables.create', ['title' => 'FinFinder | Create Fish Spot', 'fishtypes' => $fishtype]);
    }
    public function create(Request $request)
    {
        $request->validate([
            'fish_type' => 'required|array',
            'longitude' => 'required|numeric',
            'latitude' => 'required|numeric',
            'deskripsi' => 'required|string',
        ]);

        $fishTypeIds = [];


        foreach ($request->fish_type as $fishType) {
            if (is_numeric($fishType)) {
                $fishTypeIds[] = $fishType;
            } else {
                $newFishType = FishType::create(['nama' => $fishType]);
                $fishTypeIds[] = $newFishType->id;
            }
        }

        $spotIkan = SpotIkan::create([
            'tipe_ikan' => json_encode($fishTypeIds),
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
            'deskripsi' => $request->deskripsi,
            'dibuat_oleh' => Auth::id(),
        ]);

        return redirect()->route('data-ikan')->with('success', 'Berhasil Menambahkan Fish Spot Baru');
    }

    public function search(Request $request)
    {
        $term = $request->get('q');

        $fishTypes = FishType::where('nama', 'LIKE', "%$term%")
            ->select('id', 'nama as text')
            ->get();

        return response()->json($fishTypes);
    }


}
