@extends('layouts.app')

@section('content')
<section id="banner" class="w-screen py-12 pt-24 bg-[url(/public/img/profil/bg.svg)] bg-cover bg-no-repeat bg-bottom lg:pt-[120px]">
    <h2 class="text-4xl font-bold tracking-[0.2em] text-center text-slate-100">PROFIL</h2>
</section>

<section id="about" class="px-32 py-16 text-center">
    <h2 class="mb-12 text-3xl font-bold tracking-widest">Mengenai FinFinder</h2>
    <p class="text-xl [word-spacing:15px] text-justify">FinFinder adalah sebuah platform inovatif yang dikembangkan untuk membantu komunitas nelayan dalam menemukan titik potensial penangkapan ikan. Aplikasi ini dirancang dengan tujuan meningkatkan efisiensi operasi penangkapan ikan.
    </p>
</section>

<section id="fitur-utama" class="px-40 py-16 text-center">
    <h2 class="mb-12 text-3xl font-bold tracking-widest">Fitur Utama FinFinder</h2>
    <ol class="text-xl [word-spacing:15px] text-justify list-decimal">
        <li><span class="font-bold">Peta Interaktif:</span> Menampilkan sebaran titik potensial penangkapan ikan</li>
        <li><span class="font-bold">Data Ikan:</span> Menyediakan informasi tentang jenis ikan dan titik lokasi ikan tersebut.</li>
        <li><span class="font-bold">Kontribusi Pengguna:</span> Memungkinkan nelayan untuk menambahkan data baru tentang lokasi penangkapan yang potensial.</li>
        <li><span class="font-bold">Verifikasi Data:</span> Proses verifikasi oleh admin untuk menjamin keakuratan informasi yang dibagikan</li>
    </ol>
</section>
@endsection
