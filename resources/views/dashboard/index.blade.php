@extends('layouts.dashboard')

@section('content')
    <div class="flex flex-col mb-8">
        <h3 class="font-bold ">Welcome to Dashboard, {{ Auth::user()->username }}</h3>
        <p class="text-slate-400">Di sini Anda dapat melihat statistik kontribusi, memantau data, dan mengelola informasi
            perikanan. Gunakan menu di kiri untuk menjelajahi fitur-fitur aplikasi</p>
    </div>
    <div class="statistik">
        <h3 class="mb-4 font-bold">Statistik</h3>
        <div class="flex flex-wrap gap-8 lg:flex-nowrap">

            <x-card-info judul="Total Kontribusi" warna="sky" :isCheck="false" icon="database">
                <span class="counter" data-target="{{ $kontribusi }}" id="counter-kontribusi">0</span> Data
            </x-card-info>

            @if (Auth::user()->isAdmin())
                <x-card-info judul="Total Verifikasi" warna="green" :isCheck="true" icon="check">
                    <span class="counter" data-target="{{ $allVerif }}" id="counter-all-verifikasi">0</span> Data
                </x-card-info>
            @else
                <x-card-info judul="Total Data Terverifikasi" warna="green" :isCheck="true" icon="check">
                    <span class="counter" data-target="{{ $allVerified }}" id="counter-all-verifikasi">0</span> Data
                </x-card-info>
            @endif
            <x-card-info judul="Total Keselurahan Data" warna="fuchsia" :isCheck="false" icon="database">
                <span class="counter" data-target="{{ $allSpots }}" id="counter-all-datas">0</span> Data
            </x-card-info>

            <x-card-info judul="Total Pengguna" warna="red" :isCheck="false" icon="user">
                <span class="counter" data-target="{{ $allUsers }}" id="counter-all-users">0</span> Pengguna
            </x-card-info>
        </div>

        <div class="mt-8 rounded-md shadow-md bg-white-100">
            <div class="px-4 py-2 border-b border-slate-300">
                <h2 class="text-base font-semibold md:text-xl">
                    <i class="text-xl fa-solid fa-chart-simple text-sky-500"></i> Kontribusi User Bulanan
                </h2>
            </div>
            <div class="p-4 relative w-full h-[25vh] md:h-[35vh] lg:h-[60vh]">
                <canvas id="contributionChart"></canvas>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-8 mt-8 lg:grid-cols-3">
            <!-- Last Activities Section -->
            <div class="lg:col-span-2">
                <div class="h-full p-6 bg-white rounded-lg shadow-md">
                    <!-- Header -->
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-2">
                            <i class="text-sky-500 fas fa-history"></i>
                            <h2 class="text-xl font-bold">Last Activity</h2>
                        </div>
                        <a href="/data-ikan" class="text-sm text-sky-500 hover:underline">View all</a>
                    </div>

                    <!-- Activity List -->
                    <div class="divide-y divide-gray-100">
                        @foreach ($activities as $activity)
                            <div class="py-3 transition-all duration-300 hover:bg-gray-50">
                                <!-- Main Content -->
                                <div class="flex items-start justify-between gap-4">
                                    <!-- Left Side: Fish Types -->
                                    <div class="flex-1">
                                        <div class="flex flex-wrap gap-1.5 mb-2">
                                            @foreach ($activity->getFishTypes() as $ikan)
                                                <span class="px-2 py-0.5 text-xs border rounded-full border-sky-200 text-sky-700 transition-all duration-300 hover:bg-sky-100">
                                                    {{ $ikan->nama }}
                                                </span>
                                            @endforeach
                                        </div>
                                        <!-- Info Row -->
                                        <div class="flex flex-wrap items-center text-sm text-gray-500 gap-x-4 gap-y-1">
                                            <div class="flex items-center gap-1">
                                                <i class="w-4 text-sky-500 fas fa-user"></i>
                                                {{ $activity->creator->username }}
                                            </div>
                                            <div class="flex items-center gap-1">
                                                <i class="w-4 text-sky-500 fas fa-calendar"></i>
                                                {{ $activity->created_at->translatedFormat('d F Y') }}
                                            </div>
                                            <div class="flex items-center gap-1 capitalize">
                                                <i class="w-4 text-sky-500 fas fa-check "></i>
                                                Telah {{ $activity->status }}
                                            </div>
                                        </div>
                                        <div class="mt-1 text-xs text-gray-500">
                                            <i class="w-4 text-sky-500 fas fa-map-marker-alt"></i>
                                            <span class="font-mono">{{ $activity->latitude }}, {{ $activity->longitude }}</span>
                                        </div>
                                        <!-- Coordinates -->
                                    </div>

                                    <!-- Right Side: Number -->
                                    <span class="flex items-center justify-center w-6 h-6 text-xs font-medium rounded-full shrink-0 bg-sky-100 text-sky-600">
                                        {{ $loop->iteration }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>


            <!-- Top Contributor Section (1 kolom) -->
            <div class="lg:col-span-1">
                <div class="p-6 bg-white rounded-lg shadow-md ">
                    <h2 class="flex items-center justify-between mb-6">
                        <span class="flex items-center gap-2 text-xl font-bold">
                            <i class="text-sky-500 fas fa-trophy"></i>
                            Top Contributor
                        </span>
                        <span class="px-3 py-1 text-xs rounded-full bg-sky-100 text-sky-600">
                            This Month
                        </span>
                    </h2>

                    <div class="space-y-4">
                        @foreach ($topGlobals as $index => $user)
                            <div
                                class="flex items-center gap-4 p-4 transition-all duration-300 border rounded-lg hover:bg-gray-50">
                                <!-- Rank & Avatar -->
                                <div class="relative">
                                    <div class="flex items-center justify-center w-12 h-12 rounded-full bg-slate-100">
                                        <i class="text-lg fa-solid fa-user text-slate-600"></i>
                                    </div>
                                    <span
                                        class="absolute top-0 right-0 flex items-center justify-center w-5 h-5 text-xs font-bold text-white translate-x-1/2 -translate-y-1/2 rounded-full bg-sky-500">
                                        {{ $index + 1 }}
                                    </span>
                                </div>

                                <!-- User Info -->
                                <div class="flex-1">
                                    <h3 class="font-semibold text-gray-900">{{ $user->username }}</h3>
                                    <div class="flex items-center gap-3 text-sm text-gray-600">
                                        <span class="flex items-center gap-1">
                                            <i class="fas fa-map-marker-alt text-sky-500"></i>
                                            {{ $user->owner_count }} Lokasi
                                        </span>
                                        <span class="flex items-center gap-1">
                                            <i class="text-sky-500 fas fa-check"></i>
                                            {{ $user->countVerif() }} Verifikasi
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('contributionChart').getContext('2d');

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @json($labels),
                    datasets: [{
                        label: 'Jumlah Kontribusi',
                        data: @json($data),
                        fill: {
                            target: 'origin',
                            above: 'rgba(14, 165, 233, 0.1)',
                        },
                        borderColor: 'rgb(14, 165, 233)',
                        borderWidth: 2,
                        tension: 0.3,
                        pointRadius: window.innerWidth < 768 ? 3 : 5,
                        pointBackgroundColor: 'rgb(14, 165, 233)',
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false, // Penting untuk responsivitas
                    plugins: {
                        legend: {
                            display: true,
                            position: 'bottom',
                            labels: {
                                boxWidth: 12,
                                padding: window.innerWidth < 768 ? 10 : 20
                            }
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false,
                            backgroundColor: 'rgba(255, 255, 255, 0.9)',
                            titleColor: '#000',
                            bodyColor: '#000',
                            borderColor: 'rgba(0, 0, 0, 0.1)',
                            borderWidth: 1,
                            padding: 10,
                            bodyFont: {
                                size: window.innerWidth < 768 ? 12 : 14
                            },
                            titleFont: {
                                size: window.innerWidth < 768 ? 12 : 14
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)',
                                drawBorder: true
                            },
                            ticks: {
                                font: {
                                    size: window.innerWidth < 768 ? 10 : 12
                                },
                                maxTicksLimit: 6, // Batasi jumlah label Y
                                padding: window.innerWidth < 768 ? 5 : 8
                            }
                        },
                        x: {
                            grid: {
                                display: true,
                            },
                            ticks: {
                                font: {
                                    size: window.innerWidth < 768 ? 10 : 12
                                },
                                maxRotation: 0, // Mencegah rotasi label
                                padding: window.innerWidth < 768 ? 5 : 8
                            }
                        }
                    },
                    layout: {
                        padding: {
                            left: window.innerWidth < 768 ? 5 : 10,
                            right: window.innerWidth < 768 ? 5 : 10,
                            top: window.innerWidth < 768 ? 5 : 10,
                            bottom: window.innerWidth < 768 ? 5 : 10
                        }
                    }
                }
            });
        });

        // Handle resize
        window.addEventListener('resize', function() {
            const chart = Chart.getChart('contributionChart');
            if (chart) {
                chart.resize();
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Ambil semua elemen dengan class 'counter'
            const counters = document.querySelectorAll('.counter');

            // Buat array untuk menyimpan target value dari setiap counter
            const animations = Array.from(counters).map(counter => {
                const targetValue = parseInt(counter.getAttribute('data-target'));

                return anime({
                    targets: counter,
                    innerHTML: [0, targetValue],
                    round: 1, // Membulatkan angka
                    easing: 'easeInOutExpo', // Efek easing yang smooth
                    duration: 2000, // Durasi 2 detik
                    update: function(anim) {
                        counter.innerHTML = parseInt(counter.innerHTML).toLocaleString();
                    }
                });
            });
        });
    </script>
@endpush
