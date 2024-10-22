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
                            class="px-4 py-2 transition-all duration-300 hover:text-sky-500 tabs-active tabs map">Map</a>
                        <a href="#"
                            class="px-4 py-2 transition-all duraition-300 hover:text-sky-500 tabs input">Input</a>
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
        document.addEventListener('DOMContentLoaded', function() {
            let map = null;
            let currentMarker = null;

            // Inisialisasi map
            function initializeMap() {
                if (map) {
                    map.remove();
                }

                map = L.map('map', {
                    fullscreenControl: true,
                    gestureHandling: true,
                }).setView([1.3848069459548475, 102.18214794585786], 10);

                L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                }).addTo(map);

                map.on('click', function(e) {
                    const lat = e.latlng.lat;
                    const lng = e.latlng.lng;

                    console.log("Latitude:", lat, "Longitude:", lng);

                    if (currentMarker) {
                        map.removeLayer(currentMarker);
                    }

                    currentMarker = L.marker([lat, lng]).addTo(map);
                    currentMarker.bindPopup("Latitude: " + lat + "<br>Longitude: " + lng).openPopup();

                    document.getElementById('latitude').value = lat;
                    document.getElementById('longtitude').value = lng;
                });

                setTimeout(() => {
                    map.invalidateSize();
                }, 100);
            }

            const tabs = document.querySelectorAll('.tabs');
            tabs.forEach(tab => {
                tab.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Simpan nilai koordinat sebelum mengubah panel
                    const savedLat = document.getElementById('latitude')?.value || '';
                    const savedLng = document.getElementById('longtitude')?.value || '';

                    tabs.forEach(t => t.classList.remove('tabs-active'));
                    e.target.classList.add('tabs-active');

                    const panel = document.querySelector('#panel');

                    if (e.target.classList.contains('map')) {
                        panel.innerHTML = `
                    <div class="w-full mt-2 border-2 rounded-md h-80 border-slate-400" id="map"></div>
                    <input type="hidden" id="latitude" name="latitude" value="${savedLat}">
                    <input type="hidden" id="longtitude" name="longitude" value="${savedLng}">
                `;

                        setTimeout(() => {
                            initializeMap();

                            // Jika ada koordinat yang tersimpan, tambahkan marker
                            if (savedLat && savedLng) {
                                currentMarker = L.marker([savedLat, savedLng]).addTo(map);
                                currentMarker.bindPopup("Latitude: " + savedLat +
                                    "<br>Longitude: " + savedLng).openPopup();
                            }
                        }, 100);

                    } else if (e.target.classList.contains('input')) {
                        panel.innerHTML = `
                    <div class="mt-4">
                        <x-input-form id="latitude" title="Latitude" tipe="text" value="${savedLat}">
                        </x-input-form>
                    </div>
                    <div class="mt-4">
                        <x-input-form id="longtitude" title="Longitude" tipe="text" value="${savedLng}">
                        </x-input-form>
                    </div>
                `;
                    }
                });
            });

            initializeMap();
        });
    </script>
@endpush
