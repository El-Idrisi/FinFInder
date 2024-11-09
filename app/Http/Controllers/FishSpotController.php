<?php

namespace App\Http\Controllers;

use App\Models\FishType;
use App\Models\SpotIkan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class FishSpotController extends Controller
{
    public function showAll(Request $request)
    {

        if ($request->ajax()) {
            $data = SpotIkan::where('status', 'disetujui')->get();

            return DataTables::of($data)

                ->addIndexColumn()
                ->addColumn('jenis_ikan', function ($row) {
                    $fishTypes = FishType::whereIn('id', json_decode($row->tipe_ikan))
                        ->pluck('nama')
                        ->map(function ($nama) {
                            return '<span class="px-3 py-1 text-sm transition-all duration-300 border rounded-md border-sky-500 hover:bg-sky-100">'
                                . $nama .
                                '</span>';
                        });
                    return '<div class="flex flex-wrap gap-2 lg:min-w-[300px] lg:max-w-[400px]">'
                        . $fishTypes->implode(' ') .
                        '</div>';
                })
                ->addColumn('dibuat_oleh', function ($row) {
                    return $row->creator->username;
                })
                // Kolom Koordinat
                ->addColumn('koordinat', function ($row) {
                    return $row->latitude . ' , ' . $row->longitude;
                })
                // Kolom Status
                ->addColumn('status', function ($row) {
                    $bgColor = match ($row->status) {
                        'disetujui' => 'bg-green-500 hover:bg-green-600',
                        'ditolak' => 'bg-red-500 hover:bg-red-600',
                        'ditunda' => 'bg-yellow-500 hover:bg-yellow-600',
                        default => 'bg-gray-500 hover:bg-gray-600'
                    };

                    return '<span class="px-4 py-2 transition-all duration-300 rounded-md text-slate-100 ' . $bgColor . '">'
                        . ucwords($row->status) .
                        '</span>';
                })
                // Kolom Aksi
                ->addColumn('aksi', function ($row) {
                    return '<div class="flex gap-2">' .
                        // View button
                            '<a href="' . route('preview.data', $row) . '"
                                class="p-2 px-3 transition-all duration-300 rounded-md cursor-pointer bg-sky-500 text-slate-100 hover:bg-sky-600">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </a>' .
                        '</div>';
                })
                ->rawColumns(['jenis_ikan', 'status', 'aksi'])
                ->make(true);
        }

        return view('dashboard.tables.data-ikan', [
            'title' => 'FinFinder | Show Data'
        ]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $userId = Auth::id();
            $data = SpotIkan::where('dibuat_oleh', $userId)->get();

            return DataTables::of($data)
                ->addIndexColumn()
                // ->setRowId(function ($row) {
                //     return $row->id;
                // })
                // Kolom Jenis Ikan
                ->addColumn('jenis_ikan', function ($row) {
                    $fishTypes = FishType::whereIn('id', json_decode($row->tipe_ikan))
                        ->pluck('nama')
                        ->map(function ($nama) {
                            return '<span class="px-3 py-1 text-sm transition-all duration-300 border rounded-md border-sky-500 hover:bg-sky-100">'
                                . $nama .
                                '</span>';
                        });
                    return '<div class="flex flex-wrap gap-2 lg:min-w-[300px] lg:max-w-[400px]">'
                        . $fishTypes->implode(' ') .
                        '</div>';
                })
                ->addColumn('dibuat_pada_tanggal', function ($row) {
                    return $row->created_at->translatedFormat('d F Y');
                })
                // Kolom Koordinat
                ->addColumn('koordinat', function ($row) {
                    return $row->latitude . ' , ' . $row->longitude;
                })
                // Kolom Status
                ->addColumn('status', function ($row) {
                    $bgColor = match ($row->status) {
                        'disetujui' => 'bg-green-500 hover:bg-green-600',
                        'ditolak' => 'bg-red-500 hover:bg-red-600',
                        'ditunda' => 'bg-yellow-500 hover:bg-yellow-600',
                        default => 'bg-gray-500 hover:bg-gray-600'
                    };

                    return '<span class="px-4 py-2 transition-all duration-300 rounded-md text-slate-100 ' . $bgColor . '">'
                        . ucwords($row->status) .
                        '</span>';
                })
                // Kolom Aksi
                ->addColumn('aksi', function ($row) {
                    return '<div class="flex gap-2">' .
                        // View button
                        '<a href="' . route('preview.data', $row) . '"
                            class="p-2 px-3 transition-all duration-300 rounded-md cursor-pointer bg-sky-500 text-slate-100 hover:bg-sky-600">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </a>' .

                        // Edit button
                        '<a href="' . route('fish.showEdit', $row->id) . '"
                            class="p-2 px-3 transition-all duration-300 bg-yellow-500 rounded-md cursor-pointer text-slate-100 hover:bg-yellow-600">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>' .

                        // Delete form
                        '<form method="POST" class="inline delete-spotikan" action="' . route('fish.delete', $row->id) . '">
                                ' . csrf_field() . '
                                ' . method_field('DELETE') . '
                                <button type="submit"
                                    class="p-2 px-3 transition-all duration-300 bg-red-500 rounded-md cursor-pointer text-slate-100 hover:bg-red-600">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>' .
                        '</div>';
                })
                ->rawColumns(['jenis_ikan', 'status', 'aksi'])
                ->make(true);
        }

        return view('dashboard.tables.index', [
            'title' => 'FinFinder | Show Data'
        ]);
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

        return redirect()->route('data.index')->with('success', 'Berhasil Menambahkan Fish Spot Baru');
    }

    public function showEdit(SpotIkan $spotIkan)
    {
        // dd($spotIkan);
        return view('dashboard.tables.edit', ['title' => 'FinFinder | Edit Fish Spot', 'spotIkan' => $spotIkan]);
    }

    public function viewData($id)
    {
        $spotIkan = SpotIkan::find($id);
        return view('dashboard.tables.preview-data', ['title' => 'FinFinder | Show Data', 'spotIkan' => $spotIkan]);
    }

    public function update(Request $request, SpotIkan $spotIkan)
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

        $spotIkan->tipe_ikan = json_encode($fishTypeIds);
        $spotIkan->longitude = $request->longitude;
        $spotIkan->latitude = $request->latitude;
        $spotIkan->deskripsi = $request->deskripsi;
        $spotIkan->save();

        return redirect()->route('data.index')->with('success', 'Berhasil Mengubah Data Fish Spot');
    }

    public function delete(SpotIkan $spotIkan)
    {
        // dd($spotIkan);
        $spotIkan->delete();
        return redirect()->route('data.index')->with('success', 'Berhasil Menghapus Data Fish Spot');
    }
}
