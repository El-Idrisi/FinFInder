@extends('layouts.dashboard')

@section('content')
    <div class="mb-8">
        <h2 class="mb-2 text-3xl font-bold">Data Ikan</h2>
        <a href="/dashboard"
            class="after:content-['>'] transition-all duration-300 after:text-black after:px-2 hover:text-slate-500">Dashboard</a>
        <p class="inline text-slate-500">Data Ikan</p>

        <div class="relative mt-4 bg-white">
            <div class="px-4 py-2 border-b-2 border-slate-200">
                <h4 class="font-bold">Keseluruhan Data</h4>
            </div>
            <div class="relative px-4 py-4">
                <div class="overflow-x-auto shadow">

                    <table class="w-full tables">
                        <thead class="rounded-md bg-sky-300">
                            <tr class="">
                                <th class="py-3 rounded-tl-md">No</th>
                                <th class="py-3">Jenis Ikan</th>
                                <th class="py-3">Diinput Oleh</th>
                                <th class="py-3">Koordinat</th>
                                <th class="py-3">Status</th>
                                <th class="py-3 rounded-tr-md">Aksi</th>
                            </tr>
                        </thead>
                        @php
                            $i = 1
                        @endphp
                        <tbody class="rounded-md">
                            @foreach ($fishdatas as $fishspot)
                                <tr class="w-full transition-all ">
                                    <td class="py-3 text-center">{{ $i++ }}</td>
                                    <td class="flex justify-center gap-2 py-3">
                                        @foreach ($fishspot->getFishTypes() as $fishtype)
                                            <span class="px-2 py-1 transition-all duration-300 border-2 rounded-md border-sky-500 hover:bg-sky-100">{{ $fishtype->nama }}</span>
                                        @endforeach
                                    </td>
                                    <td class="py-3 text-center">{{ $fishspot->creator->username }}</td>
                                    <td class="py-3 text-center">{{ $fishspot->latitude .' , '. $fishspot->longitude }}</td>
                                    <td class="py-3 text-center">
                                        <span class="px-4 py-2 transition-all duration-300 bg-green-500 rounded-md text-slate-100 hover:bg-green-600">{{ ucwords($fishspot->status) }}</span>
                                    </td>
                                    <td class="py-3 text-center">
                                        <a
                                            class="p-2 transition-all duration-300 rounded-md cursor-pointer bg-sky-500 text-slate-100 hover:bg-sky-600"><i
                                                class=" fa-solid fa-magnifying-glass"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection
