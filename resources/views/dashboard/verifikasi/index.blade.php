@extends('layouts.dashboard')


@push('style')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    {{-- leaflet css --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/leaflet.fullscreen.css' rel='stylesheet' />
    <link rel="stylesheet" href="//unpkg.com/leaflet-gesture-handling/dist/leaflet-gesture-handling.min.css" type="text/css">

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    {{-- LeafLet.Js --}}
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/Leaflet.fullscreen.min.js'></script>
    <script src="//unpkg.com/leaflet-gesture-handling"></script>


    <style>
        /* Custom style untuk Select2 agar sesuai dengan tinggi filter date */
        .select2-container .select2-selection--single {
            height: 38px !important;
            padding: 5px 12px !important;
            border-color: rgb(229 231 235) !important;
            border-radius: 0.5rem !important;
            display: flex !important;
            align-items: center !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px !important;
            right: 5px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 26px !important;
            padding-left: 0 !important;
            color: rgb(55 65 81) !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__placeholder {
            color: #6B7280 !important;
        }

        .select2-dropdown {
            border-color: rgb(229 231 235) !important;
            border-radius: 0.5rem !important;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1) !important;
        }

        .select2-container--default .select2-search--dropdown .select2-search__field {
            padding: 8px !important;
            border-radius: 0.375rem !important;
            border-color: rgb(229 231 235) !important;
        }

        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: rgb(14 165 233) !important;
        }

        /* Pastikan container select2 memiliki margin bottom 0 */
        .select2-container {
            margin-bottom: 0 !important;
        }

        /* Hapus margin bottom dari form */
        #filterForm {
            margin-bottom: 0 !important;
        }
    </style>
@endpush

@section('content')
    <div class="mb-8">
        <h2 class="mb-2 text-3xl font-bold">Verifikasi</h2>
        <a href="/dashboard"
            class="after:content-['>'] transition-all duration-300 after:text-black after:px-2 hover:text-slate-500">Dashboard</a>
        <p class="inline text-slate-500">Verifikasi</p>

        <div class="my-6 space-y-4">
            <!-- Filter Options -->
            <form method="GET" id="filterForm">
                <div
                    class="flex flex-wrap items-center justify-between gap-4 px-4 py-2 border rounded-md shadow bg-white-100 border-slate-300">
                    {{-- Filter Count dengan Label (Sebelah Kiri) --}}
                    <div class="">
                        <label for="count">Tampilkan</label>
                        <select name="count" id="count"
                            class="h-[38px] px-2 pr-6 border rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500">
                            <option value="9" {{ request('count') == '9' ? 'selected' : '' }}>9</option>
                            <option value="15" {{ request('count') == '15' ? 'selected' : '' }}>15</option>
                            <option value="27" {{ request('count') == '27' ? 'selected' : '' }}>27</option>
                            <option value="48" {{ request('count') == '48' ? 'selected' : '' }}>48</option>
                        </select>
                    </div>

                    {{-- Wrapper untuk Fish Type, Date, dan Reset (Sebelah Kanan) --}}
                    <div class="flex flex-wrap items-center gap-4">
                        {{-- Filter Jenis Ikan --}}
                        <div class="w-64">
                            <select name="fish_type" class="fish_type">
                                <option value="">Semua Jenis Ikan</option>
                                @foreach ($fishTypes as $fish)
                                    <option value="{{ $fish->id }}"
                                        {{ request('fish_type') == $fish->id ? 'selected' : '' }}>
                                        {{ $fish->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Filter Date --}}
                        <div>
                            <select name="date" id="date"
                                class="h-[38px] px-4 border rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500">
                                <option value="terbaru" {{ request('date') == 'terbaru' ? 'selected' : '' }}>Terbaru
                                </option>
                                <option value="terlama" {{ request('date') == 'terlama' ? 'selected' : '' }}>Terlama
                                </option>
                            </select>
                        </div>

                        {{-- Tombol Reset --}}
                        <div>
                            <a href="{{ route('verifikasi.index') }}"
                                class="h-[38px] px-4 py-2 text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200">
                                Reset
                            </a>
                        </div>
                    </div>
                </div>
            </form>

        </div>


        <div class="grid grid-cols-1 gap-4 mt-8 md:grid-cols-2 lg:grid-cols-3">
            @forelse ($spots as $spot)
                <x-verif-card :spot="$spot" idMap="{{ $spot->id }}" creator="{{ $spot->creator->username }}"
                    latitude="{{ $spot->latitude }}" longitude="{{ $spot->longitude }}" :jenis-ikan="$spot->getFishTypes()"
                    date="{{ $spot->created_at->translatedFormat('d F Y') }}" />
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
        $(document).ready(function() {
            // Inisialisasi select2
            $('.fish_type').select2({
                placeholder: 'Pilih Jenis Ikan',
                allowClear: true,
                width: '100%',
            });

            // Handle perubahan nilai select2
            $('.fish_type').on('change', function() {
                $('#filterForm').submit();
            });

            $('.fish_type, #count, #date').on('change', function() {
                $('#filterForm').submit();
            });
        });


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
