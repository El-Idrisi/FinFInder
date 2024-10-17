@extends('layouts.dashboard')

@section('content')

    <div class="flex flex-col">
        <h3 class="mb-8 font-bold">Welcome to Dashboard, {{ Auth::user()->username }}</h3>
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
                {{ $users }} Pengguna
            </x-card-info>



        </div>
    </div>
@endsection
