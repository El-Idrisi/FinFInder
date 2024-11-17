<?php

namespace App\Http\Controllers;

use App\Models\FishType;
use App\Models\SpotIkan;
use Illuminate\Http\Request;

class ListIkanController extends Controller
{
    public function index(Request $request)
    {
        $count = 10;
        $sortBy = 'created_at';
        $sort = "desc";
        // $query = null;

        // Handle count/limit
        if ($request->has('count')) {
            switch ($request->count) {
                case '25':
                    $count = 25;
                    break;
                case '50':
                    $count = 50;
                    break;
                case '100':
                    $count = 100;
                    break;
                default:
                    $count = 10;
                    break;
            }
        }

        // Handle sort
        if ($request->has('sort')) {
            switch (strtolower($request->sort)) {
                case 'terbaru':
                    $sortBy = 'created_at';
                    $sort = 'desc';
                    break;
                case 'terlama':
                    $sortBy = 'created_at';
                    $sort = 'asc';
                    break;
                case 'a-z':
                    $sortBy = 'nama';
                    $sort = 'asc';
                    break;
                case 'z-a':
                    $sortBy = 'nama';
                    $sort = 'desc';
                    break;
                default:
                    $sortBy = 'created_at';
                    $sort = 'desc';
                    break;
            }
        }

        $query = FishType::orderBy($sortBy, $sort);

        if ($request->has('search')) {
            $query = $query->where('nama', 'LIKE', "%{$request->search}%");
        }

        $fishTypes = $query->paginate($count);
        return view('dashboard.jenisIkan.index', ['title' => 'FinFinder | List Ikan'], compact('fishTypes'));
    }

    public function delete($id)
    {
        FishType::where('id', $id)->first()->delete();
        return back()->with('success', "Berhasil Menghapus Jenis Ikan");
    }

    public function search(Request $request)
    {
        $term = $request->get('q');

        $fishTypes = FishType::where('nama', 'LIKE', "%$term%")
            ->select('id', 'nama as text')
            ->get();

        return response()->json($fishTypes);
    }

    public function store(Request $request)
    {
        $request->validate([
            'types' => 'required|array',
            'types.*' => 'required|string|distinct'
        ]);

        $existingTypes = FishType::whereIn('nama', $request->types)->pluck('nama');
        $newTypes = array_diff($request->types, $existingTypes->toArray());

        foreach ($newTypes as $type) {
            FishType::create(['nama' => $type]);
        }

        return response()->json([
            'message' => 'Jenis ikan berhasil ditambahkan',
            'new_types' => $newTypes
        ]);
    }

    public function update(Request $request, $id)
    {
        try {

            $request->validate([
                'fish_type' => 'required|string|max:255|unique:fish_type,nama,' . $id
            ], [
                'fish_type.required' => 'Nama ikan harus diisi',
                'fish_type.unique' => 'Jenis ikan sudah ada',
                'fish_type.max' => 'Nama ikan maksimal 255 karakter'
            ]);

            $fishType = FishType::find($id);
            $fishType->nama = $request->fish_type;
            $fishType->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Berhasil mengubah jenis ikan'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Error validasi
            return response()->json([
                'status' => 'error',
                'message' => $e->errors()['fish_type'][0]
            ], 422);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal mengubah jenis ikan'
            ], 500);
        }
    }

    public function show($id)
    {
        $fishdatas = SpotIkan::whereJsonContains('tipe_ikan', $id)
            ->orWhereRaw('JSON_CONTAINS(tipe_ikan, ?)', [$id])
            ->get();
        // dd($fishdatas);

        return view('dashboard.tables.data-ikan', ['title' => 'fishdatas'], compact('fishdatas'));
    }
}
