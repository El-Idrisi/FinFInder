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

        [role="button"] {
            cursor: default !important;
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
            <form method="GET" id="filterForm">
                <div
                    class="flex flex-col px-4 py-2 border rounded-md shadow bg-white-100 border-slate-300 md:flex-row md:items-center md:justify-between md:gap-4">
                    {{-- Filter Count Group --}}
                    <div class="w-full mb-3 md:mb-0 md:w-auto">
                        <label for="count"
                            class="block mb-1 text-sm font-medium text-gray-700 md:inline md:mr-2">Tampilkan</label>
                        <select name="count" id="count"
                            class="w-full h-[38px] px-2 pr-6 border rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500 md:w-20">
                            <option value="9" {{ request('count') == '9' ? 'selected' : '' }}>9</option>
                            <option value="15" {{ request('count') == '15' ? 'selected' : '' }}>15</option>
                            <option value="27" {{ request('count') == '27' ? 'selected' : '' }}>27</option>
                            <option value="48" {{ request('count') == '48' ? 'selected' : '' }}>48</option>
                        </select>
                    </div>

                    {{-- Filter Controls Group --}}
                    <div class="flex flex-col gap-3 md:flex-row md:items-center md:gap-4">
                        {{-- Filter Jenis Ikan --}}
                        <div class="w-full md:w-64">
                            <select name="fish_type" class="w-full fish_type">
                                <option value="">Pilih Jenis Ikan</option>
                                @foreach ($fishTypes as $fish)
                                    <option value="{{ $fish->id }}"
                                        {{ request('fish_type') == $fish->id ? 'selected' : '' }}>
                                        {{ $fish->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Sort dan Reset Group --}}
                        <div class="flex items-center gap-2">
                            {{-- Filter Date --}}
                            <select name="date" id="date"
                                class="flex-1 h-[38px] px-4 border rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500 md:flex-none">
                                <option value="terbaru" {{ request('date') == 'terbaru' ? 'selected' : '' }}>Terbaru
                                </option>
                                <option value="terlama" {{ request('date') == 'terlama' ? 'selected' : '' }}>Terlama
                                </option>
                            </select>

                            {{-- Tombol Reset --}}
                            <a href="{{ route('verifikasi.index') }}"
                                class="h-[38px] px-4 py-2 text-sm text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200">
                                Reset
                            </a>
                        </div>
                    </div>
                </div>
            </form>

        </div>

        <div id="table-container">
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
        </div>


        <div class="mt-6">
            {{ $spots->onEachSide(0)->withQueryString()->links() }}
        </div>
    </div>
@endsection


@push('script')
    <script>
        // Map Initialization
        function initCardMap(containerId, latitude, longitude) {
            const map = L.map(containerId, {
                zoomControl: false,
                dragging: false,
                scrollWheelZoom: false
            }).setView([latitude, longitude], 10);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            L.marker([latitude, longitude]).addTo(map);
            return map;
        }

        // Status Update Handling
        document.addEventListener('DOMContentLoaded', function() {
            initializeEventHandlers();
        });

        function initializeEventHandlers() {
            const confirmConfig = {
                approve: {
                    title: 'Konfirmasi Persetujuan',
                    text: 'Apakah Anda yakin ingin menyetujui data ini?',
                    icon: 'question',
                    confirmButtonColor: '#22c55e',
                    confirmButtonText: 'Ya, Setujui'
                },
                reject: {
                    title: 'Konfirmasi Penolakan',
                    text: 'Apakah Anda yakin ingin menolak data ini?',
                    icon: 'warning',
                    confirmButtonColor: '#dc2626',
                    confirmButtonText: 'Ya, Tolak'
                }
            };

            // Setup button handlers
            ['approve', 'reject'].forEach(action => {
                document.querySelectorAll(`.${action}-btn`).forEach(button => {
                    button.addEventListener('click', function() {
                        const form = this.closest('form');
                        const config = confirmConfig[action];

                        Swal.fire({
                            ...config,
                            showCancelButton: true,
                            cancelButtonColor: '#64748b',
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                updateStatus(form);
                            }
                        });
                    });
                });
            });
        }

        function updateStatus(form) {
            const formData = new FormData(form);

            fetch(form.getAttribute('action'), {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (!data.success) throw new Error(data.message);
                    return fetch(window.location.href);
                })
                .then(response => response.text())
                .then(html => {
                    const doc = new DOMParser().parseFromString(html, 'text/html');
                    const tableContainer = document.querySelector('#table-container');
                    const newTableContent = doc.querySelector('#table-container');

                    if (tableContainer && newTableContent) {
                        tableContainer.innerHTML = newTableContent.innerHTML;
                        initializeEventHandlers();
                        initializeMaps();

                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Status berhasil diperbarui',
                            icon: 'success',
                            confirmButtonColor: '#3085d6'
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        title: 'Error',
                        text: error.message || 'Terjadi kesalahan saat memperbarui status',
                        icon: 'error',
                        confirmButtonColor: '#dc2626'
                    });
                });
        }
    </script>

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


        function initializeMaps() {
            document.querySelectorAll('[id^="map-"]').forEach(container => {
                const latitude = parseFloat(container.dataset.latitude);
                const longitude = parseFloat(container.dataset.longitude);
                if (!isNaN(latitude) && !isNaN(longitude)) {
                    initCardMap(container.id, latitude, longitude);
                }
            });
        }

        initializeMaps()
    </script>
@endpush
