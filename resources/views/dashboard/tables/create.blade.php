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
                    <div class="flex my-2 border-b-2 border-slate-400">
                        <a href="#"
                            class="px-4 py-2 transition-all duration-300 hover:text-sky-500 tabs-active tabs">Map</a>
                        <a href="#" class="px-4 py-2 transition-all duraition-300 hover:text-sky-500 tabs">Input</a>
                    </div>
                    <div id="panel">
                        <div class="w-full mt-2 border-2 rounded-md h-80 border-slate-400" id="map"></div>

                        <input type="hidden" id="latitude" name="latitude">
                        <input type="hidden" id="longtitude" name="latitude">
                    </div>
                </div>

                <button type="submit"
                    class="w-full py-2 mt-8 text-lg font-bold text-center text-white transition duration-300 rounded-md bg-sky-500 hover:bg-sky-600">Tambah
                    Data</button>
            </form>
        </div>
    </div>
@endsection

@push('style')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/leaflet.fullscreen.css'
        rel='stylesheet' />
    <link rel="stylesheet" href="//unpkg.com/leaflet-gesture-handling/dist/leaflet-gesture-handling.min.css"
        type="text/css">
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/Leaflet.fullscreen.min.js'></script>
    <script src="//unpkg.com/leaflet-gesture-handling"></script>
@endpush

@push('script')
    <script>
        var map = L.map('map', {
            fullscreenControl: true,
            gestureHandling: true,

        }).setView([1.3848069459548475, 102.18214794585786], 10);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        var currentMarker = null;

        var lat, lng;
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
            // Menampilkan input koordinat
            document.getElementById('latitude').value = lat;
            document.getElementById('longtitude').value = lng;

        });
    </script>

    <script>
        const tabs = document.querySelectorAll('.tabs');
        tabs.forEach(tab => {
            tab.addEventListener('click', function(e) {
                e.preventDefault();
                const target = e.target.getAttribute('href');
                tabs.forEach(tab => {
                    tab.classList.remove('tabs-active');
                });
                e.target.classList.add('tabs-active');

                // const panels = document.querySelectorAll('.tab-panel');
                // panels.forEach(panel => {
                //     if (panel.getAttribute('id') === target.substring(1)) {
                //         panel.classList.remove('hidden');
                //     } else {
                //         panel.classList.add('hidden');
                //     }
                // });
            })
        });
    </script>
@endpush
