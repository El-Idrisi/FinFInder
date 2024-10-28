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
                <span class="counter" data-target="{{ $allSpots }}" id="counter-all-datas"></span> Data
            </x-card-info>

            <x-card-info judul="Total Pengguna" warna="red" :isCheck="false" icon="user">
                <span class="counter" data-target="{{ $allUsers }}" id="counter-all-users"></span> Pengguna
            </x-card-info>
        </div>
    </div>
@endsection

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let upto = 0;
            const counters = document.querySelectorAll('.counter');

            // Membuat array untuk menyimpan nilai target masing-masing counter
            const targetValues = [];
            counters.forEach(counter => {
                targetValues.push(parseInt(counter.getAttribute('data-target')));
            });
            console.log(targetValues);

            // Mencari nilai target tertinggi untuk menentukan kapan interval berhenti
            const maxTarget = Math.max(...targetValues);

            const counts = setInterval(updated, 100);

            function updated() {
                upto++;
                // Update semua counter
                counters.forEach((counter, index) => {
                    // Hanya update jika upto belum mencapai target counter tersebut
                    if (upto <= targetValues[index]) {
                        counter.innerHTML = upto;
                    }
                });

                // Hentikan interval jika sudah mencapai nilai tertinggi
                if (upto === maxTarget) {
                    clearInterval(counts);
                }
            }
        });
    </script>
@endpush
