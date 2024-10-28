<aside id="sidebar"
class="-translate-x-full lg:translate-x-0 h-full w-[240px] bg-white transition-all duration-300 fixed top-0 bottom-0 shadow-lg z-[999]">
<div class="px-12 py-4">
    <img src="{{ asset('img/finfinder.png') }}" alt="logo finfinder">
</div>

<div class="px-4 font-bold text-gray-400">
    <h4 class="text-sm">Menu</h4>
    <div class="flex flex-col gap-6 mt-4 ml-4">
        <a href="/dashboard" class="flex items-center gap-4 transition-all duration-300 hover:text-sky-500 {{ request()->routeIs('dashboard') ? 'text-sky-300' : ''}}">
            <img src="{{ asset('img/sidebar/Group 133.svg') }}" alt="dashboard-icon" class="scale-125">
            Dashboard
        </a>
        <a href="/" class="flex items-center gap-4 transition-all duration-300 hover:text-sky-500">
            <img src="{{ asset('img/sidebar/Group 134.svg') }}" alt="home-icon" class="scale-125">
            Beranda
        </a>
    </div>
</div>

<div class="px-4 mt-8 font-bold text-gray-400">
    <h4 class="text-sm">Tabel</h4>
    <div class="flex flex-col gap-6 mt-4 ml-4">
        <a href="/data-ikan" class="flex items-center gap-4 transition-all duration-300 hover:text-sky-500 {{ request()->routeIs('data-ikan') ? 'text-sky-300' : ''}}">
            <img src="{{ asset('img/sidebar/Group 136.svg') }}" alt="fish-icon" class="scale-125">
            Data Ikan
        </a>
        <a href="#" class="flex items-center gap-4 transition-all duration-300 hover:text-sky-500">
            <img src="{{ asset('img/sidebar/Group-137.svg') }}" alt="table-icon" class="scale-125">
            Data Anda
        </a>
        @if (Auth::user()->role == 'admin')
        <a href="#" class="flex items-center gap-4 transition-all duration-300 hover:text-sky-500">
            <img src="{{ asset('img/sidebar/Group 140.svg') }}" alt="verif-icon" class="scale-125">
            Verifikasi
        </a>
        <a href="/list-ikan" class="flex items-center gap-4 transition-all duration-300 hover:text-sky-500">
            <img src="{{ asset('img/sidebar/Group 141.svg') }}" alt="list-icon" class="scale-125">
            List Jenis Ikan
        </a>
        @endif
    </div>
</div>

<div class="flex justify-center px-4 mt-8 font-bold">
    <a href="/data-ikan/create"
        class="px-8 py-2 text-white transition-all duration-300 rounded-md bg-gradient-to-r from-violet-400 via-sky-500 to-fuchsia-400 bg-size-200 bg-pos-0 hover:bg-pos-100">
        <span class="shad"><i class="fa-solid fa-plus"></i> Tambah Data</span>
    </a>
</div>

</aside>
