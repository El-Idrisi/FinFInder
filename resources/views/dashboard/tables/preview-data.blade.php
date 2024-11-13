@extends('layouts.dashboard')

@section('content')
    <div class="mb-8">
        <h2 class="mb-2 text-3xl font-bold">Detail Data Ikan</h2>
        <a href="/dashboard"
            class="after:content-['>'] transition-all duration-300 after:text-black after:px-2 hover:text-slate-500">Dashboard</a>
        <a href="/data-ikan"
            class="after:content-['>'] transition-all duration-300 after:text-black after:px-2 hover:text-slate-500">Data
            Ikan</a>
        <p class="inline text-slate-500">Detail Data</p>
    </div>

    <div class="rounded-md shadow-md bg-white-100">
        <div class="p-4 font-bold text-white bg-sky-800 rounded-t-md">
            <h2>Detail Data</h2>
        </div>
        <div class="">

            <div class="px-4 py-6">
                <div class="mb-4">
                    <h2 class="mb-4 text-xl font-bold">Diinput Oleh</h2>
                    <div
                        class="inline px-4 py-2 transition-all duration-300 border-2 rounded-md border-sky-300 hover:bg-sky-300">
                        <i class="fa-solid fa-user"></i> {{ $spotIkan->creator->username }}
                    </div>
                </div>
                <div class="mb-4">
                    <h2 class="mb-4 text-xl font-bold">Diinput Pada Tanggal</h2>
                    <p>
                        <i class="mr-2 fa-solid fa-calendar-days"></i>
                        {{ $spotIkan->created_at->translatedFormat('d F Y') }}
                    </p>
                </div>
                <div class="mb-4">
                    <h2 class="mb-4 text-xl font-bold">Jenis Ikan</h2>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($spotIkan->getFishTypes() as $jenisIkan)
                            <span
                                class="inline px-4 py-2 transition-all duration-300 border-2 rounded-md border-sky-300 hover:bg-sky-300">{{ $jenisIkan->nama }}</span>
                        @endforeach
                    </div>
                </div>
                <div class="mb-4">
                    <h2 class="mb-2 text-xl font-bold">Deskripsi</h2>
                    <p>{!! $spotIkan->deskripsi !!}</p>
                </div>
                <div class="mb-4">
                    <h2 class="mb-2 text-xl font-bold">Status</h2>
                    <span
                        class="px-4 py-2 font-bold text-white transition-all duration-300 rounded-md {{ $spotIkan->status == 'disetujui' ? 'bg-green-500 hover:bg-green-600' : ($spotIkan->status == 'ditunda' ? 'bg-yellow-500 hover:bg-yellow-600' : 'bg-red-500 hover:bg-red-600') }}">{{ ucwords($spotIkan->status) }}</span>
                </div>
                <div class="relative w-full mt-2 border-2 rounded-md h-80 border-slate-400" id="map">
                </div>
            </div>
        </div>
    </div>
@endsection

@push('style')
    {{-- leaflet css --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/leaflet.fullscreen.css'
        rel='stylesheet' />
    <link rel="stylesheet" href="//unpkg.com/leaflet-gesture-handling/dist/leaflet-gesture-handling.min.css"
        type="text/css">

    {{-- LeafLet.Js --}}
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/Leaflet.fullscreen.min.js'></script>
    <script src="//unpkg.com/leaflet-gesture-handling"></script>

    <style>
        ul li {
            list-style: disc;
            list-style-position: inside;
        }

        ol li {
            list-style: decimal;
            list-style-position: inside;
        }

        ol li *, ul li * {
            display: inline !important;
        }
    </style>
@endpush

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const spotData = {
                latitude: {{ $spotIkan->latitude }},
                longitude: {{ $spotIkan->longitude }},
                popupContent: `
                    <div class="mb-4">
                        <h4 class="font-bold text-md">Detail Data</h4>
                    </div>
                    <div class="flex flex-wrap gap-1 mb-4">
                        @foreach ($spotIkan->getFishTypes() as $jenisIkan)
                            <span class="p-1 transition-all duration-300 border rounded w-fit border-sky-300 hover:bg-sky-300">{{ $jenisIkan->nama }}</span>
                        @endforeach
                    </div>
                    <div class="mb-4">
                        {!! $spotIkan->deskripsi !!}
                    </div>
                    <div class="border-t border-slate-200">
                        <p class="italic text-gray-400">Created by <span class="not-italic font-bold">{{ $spotIkan->creator->username }}</span></p>
                    </div>
                `
            };

            initMap({
                latitude: {{ $spotIkan->latitude }},
                longitude: {{ $spotIkan->longitude }},
                spotData
            });
        });
    </script>
@endpush
