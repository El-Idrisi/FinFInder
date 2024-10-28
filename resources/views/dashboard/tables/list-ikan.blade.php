@extends('layouts.dashboard')

@section('content')
<div class="container p-6 mx-auto">
    <div class="flex flex-wrap items-center justify-between mb-6">
        <div class="mb-4 lg:mb-0">
            <h1 class="mb-2 text-2xl font-bold text-gray-800">Daftar Jenis Ikan</h1>
            <a href="/dashboard"
                class="after:content-['>'] transition-all duration-300 after:text-black after:px-2 hover:text-slate-500">Dashboard</a>
            <p class="inline text-slate-500">List Ikan</p>
        </div>
        <button class="px-4 py-2 font-bold text-white transition-all duration-300 rounded-lg shadow-md dura bg-sky-500 hover:bg-sky-600 hover:shadow-lg">
            <i class="mr-2 fas fa-plus"></i>Tambah Jenis Ikan
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4">
        @foreach ($fishTypes as $fish)
            <div class="flex items-center justify-around py-4 my-2 transition-all duration-300 bg-white rounded-lg shadow-md lg:m-2 hover:shadow-lg">
                <h4 class="font-bold">{{ $fish->nama }}</h4>
                <div class="action">
                    <a  class="text-yellow-500 transition-all duration-300 hover:text-yellow-600"><i class="fa-solid fa-edit"></i></a>
                    <a href="{{ route('list-ikan.delete', $fish) }}" class="text-red-500 transition-all duration-300 hover:text-red-600"><i class="fa-solid fa-trash"></i></a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
