@extends('layouts.dashboard')

@section('content')
    <div class="mb-8">
        <h2 class="mb-2 text-3xl font-bold">Profile</h2>
        <a href="/dashboard"
            class="after:content-['>'] transition-all duration-300 after:text-black after:px-2 hover:text-slate-500">Dashboard</a>
        <p class="inline text-slate-500">Profile</p>
    </div>

    <div class="relative bg-white rounded-lg shadow-md -z-10">
        <div class="relative px-12 py-20 rounded-t-md bg-gradient-to-r from-cyan-300 via-sky-400 to-blue-500">
            <div
                class="absolute inline px-6 py-5 text-6xl -translate-x-1/2 -translate-y-1/2 border-8 border-white rounded-full top-full left-1/2 bg-slate-300">
                <i class="fa-solid fa-user text-slate-500"></i>
            </div>
        </div>
        <div class="py-12 pt-16 text-center">
            <h2 class="text-2xl font-bold ">{{ Auth::user()->username }}</h2>
            <h4>{{ Auth::user()->nama }}</h4>
            @if (Auth::user()->alamat)
                <p><i class="fa-solid fa-location-dot"></i> {{ Auth::user()->alamat }}</p>
            @endif
        </div>
    </div>

    <div class="flex flex-wrap gap-8 mt-8 lg:flex-nowrap">

        <div
            class="w-full p-4 transition-all duration-300 bg-white rounded-md shadow-md lg:w-1/2 hover:-translate-y-4 hover:shadow-xl">

            <h3 class="mb-4 text-lg font-bold">Data Diri</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-left whitespace-no-wrap border-collapse">
                    <tr class=" border-y border-slate-300">
                        <th class="py-2">Username</th>
                        <td class="py-2">{{ Auth::user()->username }}</td>
                    </tr>
                    <tr class=" border-y border-slate-300">
                        <th class="py-2">Nama</th>
                        <td class="py-2">{{ Auth::user()->nama }}</td>
                    </tr>
                    <tr class=" border-y border-slate-300 text-wrap">
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
        </div>

        <div
            class="w-full p-4 transition-all duration-300 bg-white rounded-md shadow-md lg:w-1/2 hover:-translate-y-4 hover:shadow-xl">
            <h3 class="mb-4 text-lg font-bold">Kontribusi</h3>
            <div class="overflow-x-auto">
                <table class="w-full text-left whitespace-no-wrap border-collapse">
                    <tr class=" border-y border-slate-300">
                        <th class="py-2">Jumlah Data yang Di Input</th>
                        <td class="py-2">{{ $kontribusi }}</td>
                    </tr>
                    @if (Auth::user()->isAdmin())
                        <tr class=" border-y border-slate-300">
                            <th class="py-2">Data yang Diverifikasi</th>
                            <td class="py-2">{{ $allVerif }}</td>
                        </tr>
                        <tr class=" border-y border-slate-300">
                            <th class="py-2">Data yang Ditolak</th>
                            <td class="py-2">{{ $allReject }}</td>
                        </tr>
                    @else
                        <tr class=" border-y border-slate-300">
                            <th class="py-2">Data yang Terverifikasi</th>
                            <td class="py-2">{{ $allVerified }}</td>
                        </tr>
                        <tr class=" border-y border-slate-300">
                            <th class="py-2">Data yang Tidak Disetujui</th>
                            <td class="py-2">{{ $allRejected }}</td>
                        </tr>
                    @endif
                    <tr class=" border-y border-slate-300">
                        <th class="py-2">Keselurahan Data</th>
                        <td class="py-2">{{ $allSpots }}</td>
                    </tr>
                </table>
            </div>
        </div>

    </div>
@endsection
