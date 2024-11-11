@extends('layouts.dashboard')


@push('style')
    {{-- leaflet css --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/leaflet.fullscreen.css' rel='stylesheet' />
    <link rel="stylesheet" href="//unpkg.com/leaflet-gesture-handling/dist/leaflet-gesture-handling.min.css" type="text/css">

    {{-- LeafLet.Js --}}
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/Leaflet.fullscreen.min.js'></script>
    <script src="//unpkg.com/leaflet-gesture-handling"></script>
@endpush

@section('content')
    <div class="mb-8">
        <h2 class="mb-2 text-3xl font-bold">Verifikasi</h2>
        <a href="/dashboard"
            class="after:content-['>'] transition-all duration-300 after:text-black after:px-2 hover:text-slate-500">Dashboard</a>
        <p class="inline text-slate-500">Verifikasi</p>

        <div class="grid grid-cols-1 gap-4 mt-8 md:grid-cols-2 lg:grid-cols-3">
            @forelse ($spots as $spot)
                <x-verif-card :spot="$spot" idMap="{{ $spot->id }}" creator="{{ $spot->creator->username }}"
                    latitude="{{ $spot->latitude }}" longitude="{{ $spot->longitude }}" :jenis-ikan="$spot->getFishTypes()" />
            @empty
                <p class="text-center">Ya Kosong~</p>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $spots->links() }}
        </div>
    </div>
@endsection


@push('script')
    <script>
        // Inisialisasi map untuk setiap card
        function initCardMap(containerId, latitude, longitude) {
            const map = L.map(containerId, {
                zoomControl: false, // Sembunyikan zoom control karena preview
                dragging: false, // Disable dragging untuk preview
                scrollWheelZoom: false // Disable zoom dengan scroll
            }).setView([latitude, longitude], 10);

            // Tambahkan tile layer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            // Tambahkan marker
            L.marker([latitude, longitude]).addTo(map);

            return map;
        }

        @foreach ($spots as $spot)
            initCardMap('map-{{ $spot->id }}', {{ $spot->latitude }}, {{ $spot->longitude }});
        @endforeach
    </script>
@endpush