<?php

namespace App\Http\Controllers;

use App\Models\FishType;
use Illuminate\Http\Request;

class ListIkanController extends Controller
{
    public function index() {
        $fishTypes = FishType::all();
        return view('dashboard.tables.list-ikan' , ['title' => 'FinFinder | List Ikan'], compact('fishTypes'));
    }

    public function delete($id) {
        $fishType = FishType::where('id', $id)->first()->delete();
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
}
