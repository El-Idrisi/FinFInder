<?php

namespace App\Http\Controllers;

use App\Models\FishType;
use App\Models\SpotIkan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DataAndaController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $fishdatas = SpotIkan::where('dibuat_oleh', $userId)->get();
        return view('dashboard.tables.index', ['title' => 'FinFinder | Show Data', 'fishdatas' => $fishdatas]);
    }

    public function show(SpotIkan $spotIkan)
    {
        return view('dashboard.tables.preview-data', ['title' => 'FinFinder | Show Data', 'spotIkan' => $spotIkan]);
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
                $fishTypeIds[] = "" . $newFishType->id;
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

        return redirect()->route('data-anda.index')->with('success', 'Berhasil Menambahkan Fish Spot Baru');
    }

    public function showEdit(SpotIkan $spotIkan)
    {
        // dd($spotIkan);
        return view('dashboard.tables.edit', ['title' => 'FinFinder | Edit Fish Spot', 'spotIkan' => $spotIkan]);
    }

    public function update(Request $request, SpotIkan $spotIkan) {
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

        $spotIkan->tipe_ikan = json_encode($fishTypeIds);
        $spotIkan->longitude = $request->longitude;
        $spotIkan->latitude = $request->latitude;
        $spotIkan->deskripsi = $request->deskripsi;
        $spotIkan->save();

        return redirect()->route('data-anda.index')->with('success', 'Berhasil Mengubah Data Fish Spot');
    }

    public function delete(SpotIkan $spotIkan)  {
        // dd($spotIkan);
        $spotIkan->delete();
        return redirect()->route('data-anda.index')->with('success', 'Berhasil Menghapus Data Fish Spot');
    }
}
