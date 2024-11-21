@extends('layouts.dashboard')

@section('content')
    <div class="flex items-center justify-between mb-8">
        <div class="">
            <h2 class="mb-2 text-3xl font-bold">Detail Data Ikan</h2>
            <a href="/dashboard"
                class="after:content-['>'] transition-all duration-300 after:text-black after:px-2 hover:text-slate-500">Dashboard</a>
            @if (request()->routeIs('verifikasi.*'))
                <a href="/verifikasi"
                    class="after:content-['>'] transition-all duration-300 after:text-black after:px-2 hover:text-slate-500">Verifikasi</a>
            @elseif(request()->routeIs('data-anda.*'))
                <a href="/data-anda"
                    class="after:content-['>'] transition-all duration-300 after:text-black after:px-2 hover:text-slate-500">Data
                    Anda</a>
            @elseif(request()->routeIs('data-ikan.*'))
                <a href="/data-ikan"
                    class="after:content-['>'] transition-all duration-300 after:text-black after:px-2 hover:text-slate-500">Data
                    Ikan</a>
            @endif
            <p class="inline text-slate-500">Detail Data</p>
        </div>

    </div>

    <div class="max-w-full">

        <!-- Content Grid -->
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            <!-- Information Section -->
            <div class="order-2 space-y-6 lg:col-span-1 lg:order-first">
                <!-- Input Info Card -->
                <div class="p-6 bg-white rounded-lg shadow-md ">
                    <h2 class="mb-4 text-lg font-semibold">
                        <i class="fa-solid fa-circle-info text-sky-500"></i> Informasi Input
                    </h2>

                    <div class="">
                        <!-- Diinput Oleh -->
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-600">Diinput Oleh</label>
                            <div
                                class="flex items-center gap-2 p-3 transition-all duration-300 rounded-lg bg-gray-50 hover:bg-gray-100">
                                <i class="text-sky-500 fas fa-user"></i>
                                <span class="font-medium">{{ $spotIkan->creator->username }}</span>
                            </div>
                        </div>

                        <!-- Diverifikasi Oleh -->
                        @if (!$spotIkan->creator->isAdmin() && !($spotIkan->status == 'ditunda'))
                            <div class="space-y-2">
                                <label class="text-sm font-medium text-gray-600">{{ ucfirst($spotIkan->status) }}
                                    Oleh</label>
                                <div
                                    class="flex items-center gap-2 p-3 transition-all duration-300 rounded-lg bg-gray-50 hover:bg-gray-100">
                                    <i class="text-sky-500 fas fa-user"></i>
                                    <span class="font-medium">{{ $spotIkan->verifier->username }}</span>
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label class="text-sm font-medium text-gray-600">{{ ucfirst($spotIkan->status) }}
                                    Oleh</label>
                                <div
                                    class="flex items-center gap-2 p-3 transition-all duration-300 rounded-lg bg-gray-50 hover:bg-gray-100">
                                    <i class="text-sky-500 fas fa-user"></i>
                                    <span class="font-medium">{{ $spotIkan->tanggal_verifikasi->translatedFormat('d F Y') }}</span>
                                </div>
                            </div>
                        @endif

                        <!-- Tanggal Input -->
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-600">Diinput Pada Tanggal</label>
                            <div
                                class="flex items-center gap-2 p-3 transition-all duration-300 rounded-lg bg-gray-50 hover:bg-gray-100">
                                <i class="text-sky-500 fas fa-calendar"></i>
                                <span>{{ $spotIkan->created_at->translatedFormat('d F Y') }}</span>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-600">Status</label>
                            <div class="p-3 rounded-lg transition-all duration-300 {{ $spotIkan->getStatusColor() }}">
                                <span class="font-medium text-white">{{ ucfirst($spotIkan->status) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Fish Types Card -->
                <div class="p-6 bg-white rounded-lg shadow-md ">
                    <h2 class="mb-4 text-lg font-semibold">
                        <i class="fa-solid fa-fish text-sky-500 drop-shadow"></i> Jenis Ikan
                    </h2>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($spotIkan->getFishTypes() as $ikan)
                            <span
                                class="px-3 py-1.5 text-sm font-medium transition-colors duration-300 border rounded-lg border-sky-200 text-sky-700 hover:bg-sky-50">
                                {{ $ikan->nama }}
                            </span>
                        @endforeach
                    </div>
                </div>

                <!-- Description Card -->

            </div>

            <!-- Map Section -->
            <div class="order-first lg:col-span-2 lg:order-2">
                <div class="h-full p-6 bg-white rounded-lg shadow-md">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold">
                            <i class="drop-shadow fa-solid fa-location-dot text-sky-500"></i> Lokasi
                        </h2>
                        <div class="hidden p-2 text-sm bg-gray-100 rounded-lg lg:block">
                            <span class="font-mono">{{ $spotIkan->latitude }}, {{ $spotIkan->longitude }}</span>
                        </div>
                    </div>

                    <div class="w-full h-[300px] lg:h-[calc(100%-55px)] overflow-hidden rounded-lg">
                        <div id="map" class="w-full h-full"></div>
                    </div>
                </div>
            </div>

            <div class="order-last lg:col-span-3">
                <div class="p-6 bg-white rounded-lg shadow-md">
                    <h2 class="mb-4 text-lg font-semibold">
                        <i class="fa-regular fa-file-lines text-sky-500"></i> Deskripsi
                    </h2>
                    <p class="text-gray-600">{!! $spotIkan->deskripsi !!}</p>
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

        ol li *,
        ul li * {
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
