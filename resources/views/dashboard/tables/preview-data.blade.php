@extends('layouts.dashboard')

@section('content')
    <x-form-group :isDelete='false' title="Detail Data">
        <div class="px-4 py-6">
            <div class="mb-4">
                <h2 class="mb-4 font-bold">Diinput Oleh</h2>
                <div
                    class="inline px-4 py-2 transition-all duration-300 border-2 rounded-md border-sky-300 hover:bg-sky-300">
                    <i class="fa-solid fa-user"></i> {{ $spotIkan->creator->username }}
                </div>
            </div>
            <div class="mb-4">
                <h2 class="mb-4 font-bold">Jenis Ikan</h2>
                <div class="flex flex-wrap gap-2">
                    @foreach ($spotIkan->getFishTypes() as $jenisIkan)
                        <span
                            class="inline px-4 py-2 transition-all duration-300 border-2 rounded-md border-sky-300 hover:bg-sky-300">{{ $jenisIkan->nama }}</span>
                    @endforeach
                </div>
            </div>
            <div class="mb-4">
                <h2 class="mb-2 font-bold">Deskripsi</h2>
                <p>{{ $spotIkan->deskripsi }}</p>
            </div>
            <div class="relative w-full mt-2 border-2 rounded-md h-80 border-slate-400" id="map">
            </div>
        </div>
    </x-form-group>
@endsection

@push('style')
    {{-- leaflet css --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/leaflet.fullscreen.css'
        rel='stylesheet' />
    <link rel="stylesheet" href="//unpkg.com/leaflet-gesture-handling/dist/leaflet-gesture-handling.min.css"
        type="text/css">

    {{-- jquery --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>


    {{-- LeafLet.Js --}}
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/Leaflet.fullscreen.min.js'></script>
    <script src="//unpkg.com/leaflet-gesture-handling"></script>
@endpush

@push('script')
    <script>
        map = L.map('map', {
            fullscreenControl: true,
            gestureHandling: true,
        }).setView([{{ $spotIkan->latitude }}, {{ $spotIkan->longitude }}], 10);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        var marker = L.marker([{{ $spotIkan->latitude }}, {{ $spotIkan->longitude }}]).addTo(map);
        marker.bindPopup(
            `
            <div class="mb-4">
                <h4 class="font-bold text-md">Detail Data</h4>
            </div>
            <div class="flex flex-wrap gap-1 mb-4">
                @foreach ($spotIkan->getFishTypes() as $jenisIkan)

                    <span class="p-1 transition-all duration-300 border rounded w-fit border-sky-300 hover:bg-sky-300">{{ $jenisIkan->nama }}</span>
                @endforeach
            </div>
            <div class="mb-4">
                {{ $spotIkan->deskripsi }} 
            </div>
            <div class="border-t border-slate-200">
                <p class="italic text-gray-400">Created by <span class="not-italic font-bold">{{ $spotIkan->creator->username }}</span></p>
            </div>
                `
        );


        var coordDisplay = L.control({
            position: 'topright'
        });

        coordDisplay.onAdd = function(map) {
            var div = L.DomUtil.create('div', 'coord-display');
            div.style.background = 'white';
            div.style.padding = '5px';
            div.style.border = '2px solid #ccc';
            return div;
        };

        coordDisplay.addTo(map);
        var coord = document.querySelector('.coord-display');
        coord.innerHTML = `
        <strong>Koordinat Titik Lokasi:</strong><br>
        Lat:{{ $spotIkan->latitude }}, Long:{{ $spotIkan->longitude }}
        `
    </script>
@endpush
