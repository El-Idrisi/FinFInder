@extends('layouts.app')

@section('content')
    <section id="banner"
        class="w-screen py-12 pt-24 bg-[url(/public/img/profil/bg.svg)] bg-cover bg-no-repeat bg-bottom lg:pt-[120px]">
        <h2 class="text-4xl font-bold tracking-[0.2em] text-center text-slate-100">Kontak Kami</h2>
    </section>

    <section id="content" class="py-32">
        <div class="w-full px-8 mx-auto lg:w-1/2">
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Velit odit corrupti quasi porro. Inventore harum excepturi, facere ipsum ab saepe praesentium natus doloribus. Dolore sunt at tempore, a ratione deserunt!</p>
        </div>
        <div class="w-full px-8 mx-auto mt-12 lg:w-1/2">
            <form action="" class="flex flex-col gap-6">
                <div class="flex flex-col justify-center gap-2">
                    <label for="nama" class="ml-3">Nama</label>
                    <input type="text" name="nama" id="nama" placeholder="nama" class="w-full px-4 py-2 rounded-full bg-slate-100 focus:outline-2 focus:outline-sky-500">
                </div>
                <div class="flex flex-col justify-center gap-2">
                    <label for="email" class="ml-3">Email</label>
                    <input type="email" name="email" id="email" placeholder="email" class="w-full px-4 py-2 rounded-full bg-slate-100 focus:outline-2 focus:outline-sky-500">
                </div>
                <div class="flex flex-col justify-center gap-2">
                    <label for="email" class="ml-3">Pesan</label>
                    <textarea type="email" name="email" id="email" placeholder="masukan pesan dan saran Anda." class="w-full h-32 px-4 py-2 rounded-lg bg-slate-100 focus:outline-2 focus:outline-sky-500"></textarea>
                </div>

                <button type="submit" class="py-2 transition-all duration-300 rounded-full text-slate-100 bg-sky-500 hover:bg-sky-600">Kirim Pesan</button>
            </form>
        </div>
    </section>
@endsection
