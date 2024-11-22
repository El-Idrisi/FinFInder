<header
    class="absolute top-0 z-50 flex items-center justify-around w-full h-20 transition-all duration-300 bg-transparent text-slate-100 navbar-home">
    <div class="navbar-brand">
        <a href="/">
            <img src="{{ asset('img/finfinder.png') }}" alt="FinFinder Logo"
                class="w-[130px] grayscale transition-all duration-300 hover:grayscale-0">
        </a>
    </div>
    <nav id="navbar-list" class="hidden lg:block li">
        <ul class="flex items-center justify-center gap-12 list-none">
            <li class="list-none">
                <a href="/"
                    class="flex flex-col items-center justify-center transition-all duration-300 hover:text-sky-500 group {{ request()->routeIs('beranda') ? 'active' : '' }}">
                    Beranda
                    <hr class="w-0 transition-all duration-500 group-hover:border-sky-500 group-hover:w-full">
                </a>
            </li>
            <li class="list-none">
                <a href="/profil"
                    class="flex flex-col items-center justify-center transition-all duration-300 hover:text-sky-500 group {{ request()->routeIs('profil') ? 'active' : '' }}">
                    Profil
                    <hr class="w-0 transition-all duration-500 group-hover:border-sky-500 group-hover:w-full">
                </a>
            </li>
            <li class="list-none">
                <a href="/peta-interaktif"
                    class="flex flex-col items-center justify-center transition-all duration-300 hover:text-sky-500 group">
                    Peta Interaktif
                    <hr class="w-0 transition-all duration-500 group-hover:border-sky-500 group-hover:w-full">
                </a>
            </li>
            <li class="list-none">
                <a href="/contact-us"
                    class="flex flex-col items-center justify-center transition-all duration-300 hover:text-sky-500 group {{ request()->routeIs('contact') ? 'active' : '' }}">
                    Kontak Kami
                    <hr class="w-0 transition-all duration-500 group-hover:border-sky-500 group-hover:w-full">
                </a>
            </li>
        </ul>
    </nav>
    <div class="items-center justify-center hidden gap-4 lg:flex">
        @if (Auth::check())
            <a href="/dashboard"
                class="flex flex-col items-center justify-center transition-all duration-300 hover:text-sky-500 group">
                Dashboard
                <hr class="w-0 transition-all duration-500 group-hover:border-sky-500 group-hover:w-full">
            </a>
            <a href=""
                class="px-4 py-2 transition-all duration-300 rounded-lg bg-sky-500 text-slate-100 hover:bg-sky-600">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit">
                        Log Out
                    </button>
                </form>
            </a>
        @else
            <a href="/dashboard"
                class="flex flex-col items-center justify-center transition-all duration-300 hover:text-sky-500 group">
                Login
                <hr class="w-0 transition-all duration-500 group-hover:border-sky-500 group-hover:w-full">
            </a>
            <a href="/register"
                class="px-4 py-2 transition-all duration-300 rounded-lg bg-sky-500 text-slate-100 hover:bg-sky-600">Sign
                Up</a>
        @endif
    </div>
    <button class="block hamburger-icon lg:hidden">
        <span class="w-[30px] h-[2px] my-2 block bg-slate-900 transition-all duration-300"></span>
        <span class="w-[30px] h-[2px] my-2 block bg-slate-900 transition-all duration-300"></span>
        <span class="w-[30px] h-[2px] my-2 block bg-slate-900 transition-all duration-300"></span>
    </button>

    <nav id="nav-menu"
        class="absolute top-0 right-0 w-full transition-all duration-300 -translate-y-full bg-slate-100 h-[20.5rem] text-slate-900 -z-10 lg:hidden">
        <div class="absolute w-full px-4 -z-10 top-20">
            <div class="flex flex-col px-4 py-2 border-2 border-slate-900">
                <a href="/"
                    class="my-2 transition-all duration-300 hover:text-sky-500 {{ request()->routeIs('beranda') ? 'text-sky-500 font-bold' : '' }}">Beranda</a>
                <a href="/profil"
                    class="my-2 transition-all duration-300 hover:text-sky-500 {{ request()->routeIs('profil') ? 'text-sky-500 font-bold' : '' }}">Profil</a>
                <a href="/peta-interaktif" class="my-2 transition-all duration-300 hover:text-sky-500">Peta Interaktif</a>
                <a href="/contact-us"
                    class="my-2 transition-all duration-300 hover:text-sky-500 {{ request()->routeIs('contact') ? 'text-sky-500 font-bold' : '' }}">Kontak
                    Kami</a>
            </div>
            <div class="px-2 pb-4 mt-6 mb-4">
                @if (Auth::check())
                    <a href="/dashboard" class="mx-2 transition-all duration-300 hover:text-sky-500">
                        Dashboard
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="px-4 py-2 mx-3 transition-all duration-300 rounded-lg bg-sky-500 text-slate-100 hover:bg-sky-600">
                            Log Out
                        </button>
                    </form>
                @else
                    <a href="/dashboard" class="mx-2 transition-all duration-300 hover:text-sky-500">
                        Login
                    </a>
                    <a href="/register"
                        class="px-4 py-2 mx-2 transition-all duration-300 rounded-lg bg-sky-500 text-slate-100 hover:bg-sky-600">Sign
                        Up
                    </a>
                @endif
            </div>
        </div>



    </nav>
</header>
