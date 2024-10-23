<?php

namespace App\Http\Controllers;

use App\Models\FishType;
use Illuminate\Http\Request;

class FishSpotController extends Controller
{
    public function showCreate()
    {
        $fishtype = FishType::all();
        return view('dashboard.tables.create', ['title' => 'FinFinder | Create Fish Spot', 'fishtypes' => $fishtype]);
    }
    public function create(Request $request)
    {
        dd($request->all());
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
