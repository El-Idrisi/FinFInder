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

        <div class="mt-8 bg-white rounded-lg shadow-md">
            <div class="px-4 py-2 border-b border-slate-300">
                <h2 class="text-base font-semibold md:text-lg">
                    Kontribusi User Bulanan
                </h2>
            </div>
            <div class="p-4 relative w-full h-[25vh] md:h-[35vh] lg:h-[60vh]">
                <canvas id="contributionChart"></canvas>
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
