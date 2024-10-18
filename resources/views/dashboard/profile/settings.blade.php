@extends('layouts.dashboard')

@section('content')
    <div class="flex flex-col gap-12">
        <div class="w-full bg-white rounded-lg shadow">
            <div
                class="text-white transition-all duration-300 rounded-t-lg cursor-pointer bg-sky-800 accordion hover:bg-sky-700">
                <h4 class="px-4 py-2 font-bold">Profile</h4>
            </div>
            <div class="overflow-hidden accor active">
                <form action="{{ route('update.profile') }}" method="POST" class="px-8 py-6">
                    @csrf
                    @method('PUT')
                    <div class="flex flex-wrap gap-12 lg:flex-nowrap">
                        <div class="flex flex-col w-full">
                            <label for="username" class="mb-2 font-bold">Username</label>
                            <input type="text" name="username" id="username"
                                class="p-2 border-2 rounded-md outline-2 border-slate-400 focus:outline-sky-500"
                                placeholder="Username" autocomplete="off" value="{{ $user->username }}">
                            @error('username')
                                <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col w-full">
                            <label for="nama" class="mb-2 font-bold">Nama</label>
                            <input type="text" name="nama" id="nama"
                                class="p-2 border-2 rounded-md outline-2 border-slate-400 focus:outline-sky-500"
                                placeholder="Nama" autocomplete="off" value="{{ $user->nama }}">
                            @error('nama')
                                <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-12 mt-8 lg:flex-nowrap">
                        <div class="flex flex-col w-full">
                            <label for="no.telp" class="mb-2 font-bold">Nomor Telephone</label>
                            <input type="tel" name="no.telp" id="no.telp"
                                class="p-2 border-2 rounded-md outline-2 border-slate-400 focus:outline-sky-500"
                                placeholder="No.Telp" value="{{ $user->no_telp }}">
                            @error('no_telp')
                                <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex flex-col w-full">
                            <label for="tanggal_lahir" class="mb-2 font-bold">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                                class="p-2 border-2 rounded-md outline-2 border-slate-400 focus:outline-sky-500"
                                placeholder="Tanggal Lahir" value="{{ $user->tanggal_lahir }}">
                            @error('tanggal_lahir')
                                <p class="text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex flex-col mt-8">
                        <label for="alamat" class="mb-2 font-bold">Alamat</label>
                        <textarea name="alamat" id="alamat" placeholder="Alamat" rows="3"
                            class="p-2 border-2 rounded-md resize-none outline-2 border-slate-400 focus:outline-sky-500">{{ $user->alamat }}</textarea>
                        @error('alamat')
                            <p class="text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                        class="px-4 py-2 mt-8 font-bold text-white transition-all duration-300 rounded-lg bg-sky-500 hover:bg-sky-600">Update
                        Profile</button>
                </form>
            </div>
            <div class="py-4 border-t rounded-b-lg border-slate-300"></div>
        </div>
    </div>
@endsection
