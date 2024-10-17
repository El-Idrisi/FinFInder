<aside id="sidebar"
class="-translate-x-full lg:translate-x-0 h-full w-[240px] bg-white transition-all duration-300 fixed top-0 bottom-0 shadow-lg z-[99999999]">
<div class="px-12 py-4">
    <img src="{{ asset('img/finfinder.png') }}" alt="logo finfinder">
</div>

<div class="px-4 font-bold text-gray-400">
    <h4 class="text-sm">Menu</h4>
    <div class="flex flex-col gap-6 mt-4 ml-4">
        <a href="/dashboard" class="flex items-center gap-4 transition-all duration-300 hover:text-sky-500 {{ request()->routeIs('dashboard') ? 'text-sky-300' : ''}}">
            <img src="{{ asset('img/sidebar/Group 133.svg') }}" alt="dashboard-icon" class="scale-125">
            Dashboards
        </a>
        <a href="/" class="flex items-center gap-4 transition-all duration-300 hover:text-sky-500">
            <img src="{{ asset('img/sidebar/Group 134.svg') }}" alt="dashboard-icon" class="scale-125">
            Home
        </a>
    </div>
</div>

<div class="px-4 mt-8 font-bold text-gray-400">
    <h4 class="text-sm">Tables</h4>
    <div class="flex flex-col gap-6 mt-4 ml-4">
        <a href="#" class="flex items-center gap-4 transition-all duration-300 hover:text-sky-500">
            <img src="{{ asset('img/sidebar/Group 136.svg') }}" alt="dashboard-icon" class="scale-125">
            Data Ikan
        </a>
        <a href="#" class="flex items-center gap-4 transition-all duration-300 hover:text-sky-500">
            <img src="{{ asset('img/sidebar/Group 137.svg') }}" alt="dashboard-icon" class="scale-125">
            Your Data
        </a>
        @if (Auth::user()->role == 'admin')
        <a href="#" class="flex items-center gap-4 transition-all duration-300 hover:text-sky-500">
            <img src="{{ asset('img/sidebar/Group 140.svg') }}" alt="dashboard-icon" class="scale-125">
            Tabel Verifikasi
        </a>
        @endif
    </div>
</div>

<div class="px-4 mt-8 font-bold">
    <a href="#"
        class="px-[3.5rem] py-2 text-white bg-gradient-to-r from-violet-400    via-sky-500 to-fuchsia-400 rounded-md bg-size-200 bg-pos-0 transition-all duration-300 hover:bg-pos-100">
        <span class="shad"><i class="fa-solid fa-plus"></i> Add Data</span>
    </a>
</div>

</aside>
