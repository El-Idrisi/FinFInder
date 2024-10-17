@extends('layouts.dashboard')

@section('content')
    <div class="flex flex-wrap gap-12 lg:flex-nowrap">

        <x-card-info judul="Total Kontribusi" warna="sky"  :isCheck="false">
            <i class="fa-solid fa-database text-sky-500"></i>
        </x-card-info>

        <x-card-info judul="Total Data Terverifikasi" warna="green" :isCheck="true">
            <i class="text-3xl text-green-500 fa-solid fa-check"></i>
        </x-card-info>

        <x-card-info judul="Total Pesan" warna="fuchsia"  :isCheck="false">
            <i class="fa-solid fa-database text-fuchsia-500"></i>
        </x-card-info>

        <x-card-info judul="Total Pengguna" warna="red"  :isCheck="false">
            <i class="text-red-500 fa-solid fa-user"></i>
        </x-card-info>



    </div>
@endsection
