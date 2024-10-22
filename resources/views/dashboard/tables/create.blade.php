@extends('layouts.dashboard')

@section('content')
    <div class="bg-white rounded-md shadow-md">
        <div class="px-4 py-2 bg-sky-700 rounded-t-md">
            <h4 class="font-bold text-white">Tambah Data</h4>
        </div>
        <div class="px-8 py-4">
            <form action="">
                @csrf

                <x-input-form id="tipeIkan" title="Tipe Ikan" tipe="text" value="">
                </x-input-form>

                <x-textarea-input id="deskripsi" title="Deskripsi"></x-textarea-input>

                <div class="mt-4">
                    <h4 class="font-bold">Koordinat </h4>
                    <div class="flex gap-4 my-2 border-b-2 border-slate-400">
                        <a href="#" class="px-4 hover:text-sky-500 tabs-active">Map</a>
                        <a href="#" class="hover:text-slate-500">Input</a>
                    </div>
                    <div class="w-full mt-2 border-2 rounded-md h-80 border-slate-400" id="map"></div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('style')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/leaflet.fullscreen.css'
        rel='stylesheet' />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/Leaflet.fullscreen.min.js'></script>
@endpush

@push('script')
    <script>
        var map = L.map('map', {
            fullscreenControl: true,

        }).setView([1.3848069459548475, 102.18214794585786], 10);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        var currentMarker = null;

        map.on('click', function(e) {
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;

            console.log("Latitude:", lat, "Longitude:", lng);

            // Hapus marker sebelumnya jika ada
            if (currentMarker) {
                map.removeLayer(currentMarker);
            }

            // Buat marker baru
            currentMarker = L.marker([lat, lng]).addTo(map);

            // Anda bisa menambahkan popup jika ingin menampilkan koordinat pada marker
            currentMarker.bindPopup("Latitude: " + lat + "<br>Longtitude: " + lng).openPopup();
        });
    </script>
@endpush
