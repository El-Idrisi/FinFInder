@extends('layouts.dashboard')

@section('content')
    <div class="flex flex-col mb-8">
        <h3 class="font-bold ">Welcome to Dashboard, {{ Auth::user()->username }}</h3>
        <p class="text-slate-400">Di sini Anda dapat melihat statistik kontribusi, memantau data, dan mengelola informasi
            perikanan. Gunakan menu di kiri untuk menjelajahi fitur-fitur aplikasi</p>
    </div>
    <div class="statistik">
        <h3 class="mb-4 font-bold">Statistik</h3>
        <div class="flex flex-wrap gap-12 lg:flex-nowrap">

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
    </div>
@endsection

@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>

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
