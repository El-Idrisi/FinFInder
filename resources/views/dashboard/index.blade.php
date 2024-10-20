@extends('layouts.dashboard')

@section('content')

    <div class="flex flex-col mb-8">
        <h3 class="font-bold ">Welcome to Dashboard, {{ Auth::user()->username }}</h3>
        <p class="text-slate-400">Di sini Anda dapat melihat statistik kontribusi, memantau data, dan mengelola informasi perikanan. Gunakan menu di kiri untuk menjelajahi fitur-fitur aplikasi</p>
    </div>
    <div class="statistik">
        <h3 class="mb-4 font-bold">Statistik</h3>
        <div class="flex flex-wrap gap-12 lg:flex-nowrap">

            <x-card-info judul="Total Kontribusi" warna="sky" :isCheck="false" icon="database">
                0 Data
            </x-card-info>

            <x-card-info judul="Total Data Terverifikasi" warna="green" :isCheck="true" icon="check">
                0 Data
            </x-card-info>

            <x-card-info judul="Total Keselurahan Data" warna="fuchsia" :isCheck="false" icon="database">
                0 Data
            </x-card-info>

            <x-card-info judul="Total Pengguna" warna="red" :isCheck="false" icon="user">
                <span id="counter"></span> Pengguna
            </x-card-info>



        </div>
    </div>
@endsection

@push('script')
    <script>
        let upto = 0;
        let counts = setInterval(updated, 100);

        function updated() {
            let count = document.getElementById("counter");
            count.innerHTML = ++upto;
            if (upto === {{ $users }}) {
                clearInterval(counts);
            }
        }
    </script>
@endpush
