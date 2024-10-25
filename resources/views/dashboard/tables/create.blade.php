@extends('layouts.dashboard')

@section('content')
    <div class="mb-8">
        <h2 class="mb-2 text-3xl font-bold">Tambah Data</h2>
        <a href="/dashboard"
            class="after:content-['>'] transition-all duration-300 after:text-black after:px-2 hover:text-slate-500">Dashboard</a>
        <a href="/data-ikan"
            class="after:content-['>'] transition-all duration-300 after:text-black after:px-2 hover:text-slate-500">Data
            Ikan</a>
        <p class="inline text-slate-500">Tambah</p>
    </div>

    <div class="bg-white rounded-md shadow-md ">
        <div class="px-4 py-2 bg-sky-700 rounded-t-md">
            <h4 class="font-bold text-white">Tambah Data</h4>
        </div>
        <div class="px-8 py-4">
            <form action="{{ route('fish.create') }}" method="POST">
                @csrf

                <div class="flex flex-col !w-full mb-4">
                    <label for="fish_type" class="mb-2 font-bold">Jenis Ikan</label>
                    <select name="fish_type[]" id="fish_type" class="h-10 border-2 rounded-md border-slate-400"
                        multiple="multiple">
                    </select>
                    <p class="text-red-500">
                        @error('fish_type')
                            {{ $message }}
                        @enderror
                    </p>
                </div>

                <x-textarea-input id="deskripsi" title="Deskripsi"></x-textarea-input>
                <p class="text-red-500">
                    @error('deskripsi')
                        {{ $message }}
                    @enderror
                </p>

                <div class="mt-4">
                    <h4 class="font-bold">Koordinat </h4>
                    <div
                        class="relative flex items-center justify-start w-full text-lg font-bold border-b-2 border-slate-300">
                        <a href="#"
                            class="p-4 text-lg font-bold border-none cursor-pointer text-slate-500 bg-none tabs tab-active map">Map</a>
                        <a href="#"
                            class="p-4 text-lg font-bold border-none cursor-pointer text-slate-500 bg-none tabs input">Input</a>
                        <div
                            class="absolute -bottom-[3px] rounded-md left-0 w-20 h-1 bg-sky-500 transition-all duration-300 line">
                        </div>
                    </div>
                    <div id="panel">
                        <div class="w-full mt-2 border-2 rounded-md h-80 border-slate-400" id="map"></div>

                        <input type="hidden" id="latitude" name="latitude">
                        <input type="hidden" id="longitude" name="longitude">
                        <p class="text-red-500">
                            @error('latitude')
                                {{ $message }}
                            @enderror
                            @error('longitude')
                                {{ $message }}
                            @enderror
                        </p>
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
    {{-- leaflet css --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/leaflet.fullscreen.css'
        rel='stylesheet' />
    <link rel="stylesheet" href="//unpkg.com/leaflet-gesture-handling/dist/leaflet-gesture-handling.min.css"
        type="text/css">

    {{-- select2 css --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    {{-- jquery --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    {{-- select2.js --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    {{-- LeafLet.Js --}}
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
                    document.getElementById('longitude').value = lng;
                });

                setTimeout(() => {
                    map.invalidateSize();
                }, 100);
            }

            const tabs = document.querySelectorAll('.tabs');
            tabs.forEach((tab, index) => {
                tab.addEventListener('click', function(e) {
                    e.preventDefault();
                    console.log(tab)
                    tabs.forEach(tab => {
                        tab.classList.remove('tab-active')
                    });
                    tab.classList.add('tab-active');

                    var line = document.querySelector('.line');
                    line.style.width = e.target.offsetWidth + 'px';
                    line.style.left = e.target.offsetLeft + 'px';

                    const savedLat = document.getElementById('latitude')?.value || '';
                    const savedLng = document.getElementById('longitude')?.value || '';

                    tabs.forEach(t => t.classList.remove('tabs-active'));
                    e.target.classList.add('tabs-active');

                    const panel = document.querySelector('#panel');

                    if (e.target.classList.contains('map')) {
                        panel.innerHTML = `
                    <div class="w-full mt-2 border-2 rounded-md h-80 border-slate-400" id="map"></div>
                    <input type="hidden" id="latitude" name="latitude" value="${savedLat}">
                    <input type="hidden" id="longitude" name="longitude" value="${savedLng}">

                    <p class="text-red-500">
                        @error('latitude')
                            {{ $message }}
                        @enderror
                        @error('longitude')
                            {{ $message }}
                        @enderror
                    </p>
                `;

                        setTimeout(() => {
                            initializeMap();

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
                        <x-input-form id="longitude" title="Longitude" tipe="text" value="${savedLng}">
                        </x-input-form>
                    </div>
                `;
                    }

                });
            });

            initializeMap();
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#fish_type').select2({
                placeholder: "Pilih Jenis Ikan",
                tokenSeparators: [','],
                allowClear: true,
                tags: true,
                ajax: {
                    url: '{{ route('fish-types.search') }}',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                },
                createTag: function(params) {
                    // Jika tidak ada matches, buat tag baru
                    const term = $.trim(params.term);
                    if (term === '') {
                        return null;
                    }

                    return {
                        id: term, // Menandai bahwa ini adalah tag baru
                        text: term, // Menambahkan indikator bahwa ini tag baru
                        newTag: true // Flag untuk menandai ini adalah tag baru
                    };
                },
            });
        });
    </script>
@endpush
