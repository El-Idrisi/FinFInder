@extends('layouts.dashboard')

@section('content')
    {{-- <p>{{ Auth::user() }}</p> --}}
    <div class="relative bg-white rounded-lg shadow-md -z-10 ">
        <div class="relative px-12 py-20 bg-gradient-to-r from-sky-500 via-indigo-500 to-fuchsia-300 rounded-t-md">

            <div
                class="absolute inline px-6 py-5 text-6xl -translate-x-1/2 -translate-y-1/2 border-8 border-white rounded-full top-full left-1/2 bg-slate-300">
                <i class="fa-solid fa-user text-slate-500"></i></div>
        </div>
        <div class="py-12 pt-16 text-center">
            <h2 class="text-2xl font-bold ">{{ Auth::user()->username }}</h2>
            <h4>{{ Auth::user()->nama }}</h4>
            @if (Auth::user()->alamat)
                <p><i class="fa-solid fa-location-dot"></i> {{ Auth::user()->alamat }}</p>
            @endif
        </div>
    </div>

    <div class="flex gap-8 mt-8">

        <div class="w-1/2 p-4 bg-white rounded-md shadow-md">
            <h3 class="mb-4 text-lg font-bold">Data Diri</h3>
            <table class="w-full text-left whitespace-no-wrap border-collapse">
                <tr class=" border-y border-slate-300">
                    <th class="py-2">Username</th>
                    <td class="py-2">{{ Auth::user()->username }}</td>
                </tr>
                <tr class=" border-y border-slate-300">
                    <th class="py-2">Nama</th>
                    <td class="py-2">{{ Auth::user()->nama }}</td>
                </tr>
                <tr class=" border-y border-slate-300">
                    <th class="py-2">Email</th>
                    <td class="py-2">{{ Auth::user()->email }}</td>
                </tr>
                <tr class=" border-y border-slate-300">
                    <th class="py-2">No. Telp</th>
                    <td class="py-2">{{ Auth::user()->no_telp }}</td>
                </tr>
                <tr class=" border-y border-slate-300">
                    <th class="py-2">Tanggal Lahir</th>
                    <td class="py-2">{{ Auth::user()->tanggal_lahir }}</td>
                </tr>
                <tr class=" border-y border-slate-300">
                    <th class="py-2">Alamat</th>
                    <td class="py-2">{{ Auth::user()->alamat }}</td>
                </tr>
            </table>
        </div>

        <div class="w-1/2 p-4 bg-white rounded-md shadow-md">
            <h3 class="mb-4 text-lg font-bold">Kontribusi</h3>
            <table class="w-full text-left whitespace-no-wrap border-collapse">
                <tr class=" border-y border-slate-300">
                    <th class="py-2">Jumlah Data yang Di Input</th>
                    <td class="py-2">0</td>
                </tr>
                <tr class=" border-y border-slate-300">
                    <th class="py-2">Data yang Diverifikasi</th>
                    <td class="py-2">0</td>
                </tr>
                <tr class=" border-y border-slate-300">
                    <th class="py-2">Data yang Ditolak</th>
                    <td class="py-2">0</td>
                </tr>
                <tr class=" border-y border-slate-300">
                    <th class="py-2">Keselurahan Data</th>
                    <td class="py-2">0</td>
                </tr>
            </table>
        </div>

    </div>
@endsection
