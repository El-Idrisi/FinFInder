@extends('layouts.dashboard')

@section('content')
    <div class="flex flex-wrap gap-12 lg:flex-nowrap">

        <div class="w-full p-4 bg-white rounded-md shadow-md lg:w-1/4">
            <h4 class="font-semibold text-slate-400">Total Kontribusi</h4>
            <div class="flex justify-between mt-4 text-2xl font-semibold">
                <h4 class="">0 Data</h4>
                <span class="px-4 py-2 rounded bg-sky-200 "><i class="fa-solid fa-database text-sky-500"></i></span>
            </div>
        </div>

        <div class="w-full p-4 bg-white rounded-md shadow-md lg:w-1/4">
            <h4 class="font-semibold text-slate-400">Total Data Terverifikasi</h4>
            <div class="flex justify-between mt-4 text-2xl font-semibold">
                <h4 class="">0 Data</h4>
                <span class="px-3 py-1 bg-green-200 rounded "><i class="text-3xl text-green-500 fa-solid fa-check"></i>
            </div>
        </div>

        <div class="w-full p-4 bg-white rounded-md shadow-md lg:w-1/4">
            <h4 class="font-semibold text-slate-400">Total Pesan</h4>
            <div class="flex justify-between mt-4 text-2xl font-semibold">
                <h4 class="">0 Data</h4>
                <span class="px-4 py-2 rounded bg-fuchsia-200 "><i class="text-fuchsia-500 bi bi-chat-left-dots"></i></span>
            </div>
        </div>

        <div class="w-full p-4 bg-white rounded-md shadow-md lg:w-1/4">
            <h4 class="font-semibold text-slate-400">Total Pengguna</h4>
            <div class="flex justify-between mt-4 text-2xl font-semibold">
                <h4 class="">0 Data</h4>
                <span class="px-4 py-2 bg-red-200 rounded "><i class="text-red-500 fa-solid fa-user"></i></span>
            </div>
        </div>

    </div>
@endsection
