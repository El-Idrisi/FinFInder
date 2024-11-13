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

        <div class="mb-6 space-y-4">
            <!-- Filter Options -->
            <div class="flex flex-wrap justify-end gap-4">

                <form method="GET" class="mb-6">
                    <select name="fish_type"
                        class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500"
                        onchange="this.form.submit()">
                        <option value="">Semua Jenis Ikan</option>
                        @foreach ($fishTypes as $fish)
                            <option value="{{ $fish->id }}" {{ request('fish_type') == $fish->id ? 'selected' : '' }}>
                                {{ $fish->nama }}
                            </option>
                        @endforeach
                    </select>
                </form>

                <form method="GET" class="mb-6">
                    <select name="date" class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500" onchange="this.form.submit()">
                        <option value="terbaru" {{ request('date') == 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                        <option value="terlama" {{ request('date') == 'terlama' ? 'selected' : '' }}>Terlama</option>
                    </select>
                </form>
            </div>
        </div>


        <div class="grid grid-cols-1 gap-4 mt-8 md:grid-cols-2 lg:grid-cols-3">
            @forelse ($spots as $spot)
                {{-- {{ $spot->tipe_ikan }}<br><br> --}}
                <x-verif-card :spot="$spot" idMap="{{ $spot->id }}" creator="{{ $spot->creator->username }}"
                latitude="{{ $spot->latitude }}" longitude="{{ $spot->longitude }}" :jenis-ikan="$spot->getFishTypes()"
                date="{{ $spot->created_at->translatedFormat('d F Y') }}"/>
            @empty
                <div
                    class="col-span-1 py-2 border rounded-md shadow md:col-span-2 lg:col-span-3 bg-white-100 border-slate-300 ">
                    <p class="text-lg text-center text-gray-700">Ya Kosong~</p>
                </div>
            @endforelse
        </div>


        <div class="mt-6">
            {{ $spots->onEachSide(1)->withQueryString()->links() }}
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
