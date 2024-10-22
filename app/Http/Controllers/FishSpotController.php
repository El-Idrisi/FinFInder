<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FishSpotController extends Controller
{
    public function create(Request $request) {
        dd($request->all());
    }
}
