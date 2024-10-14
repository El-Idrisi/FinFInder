<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
    <script src="https://kit.fontawesome.com/bd2b93a447.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite('resources/css/app.css')
    <title>{{ $title }}</title>
</head>

<body class="relative font-inter -z-[9999] overflow-x-hidden">

    <div class="flex">
        <aside id="sidebar" class="h-screen w-[300px] bg-sky-900 text-slate-100 relative transition-all duration-300">
            <div class="px-12 py-4 border-b border-sky-700">
                <img src="{{ asset('img/finfinder.png') }}" alt="logo finfinder">
            </div>

            <div class="flex flex-col justify-center w-full border-b border-sky-700">

                <button
                    class="flex items-center justify-between w-full px-8 py-4 transition-all duration-300 accordion hover:bg-sky-800">
                    <span class="text-lg"><i class="mr-1 text-lg fa-solid fa-user"></i> {{ Auth::user()->username }}</span>
                    <i class="text-lg transition-transform duration-300 fa-solid fa-chevron-down"></i>
                </button>

                <div class="overflow-hidden text-lg transition-all duration-300 accordion-content">
                    <a href="" class="block w-full px-8 py-2 transition-all duration-300 hover:bg-sky-800"><i class="fa-solid fa-gear"></i>
                        Settings</a>
                    <a class="block w-full px-8 py-2 transition-all duration-300 list-group-item logout hover:bg-sky-800">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="text-red-500">
                                <i class="fa-solid fa-door-open"></i>
                                Log Out
                            </button>
                        </form>
                    </a>
                </div>

            </div>

            <div class="px-8 py-4 text-lg hover:bg-sky-800 transition-all duration-300 {{ request()->routeIs('dashboard') ? 'bg-sky-700': '' }}">
                <a href="">
                    <i class="fa-solid fa-gauge-high"></i> Dashboard
                </a>
            </div>

            <div class="flex flex-col justify-center w-full">

                <button
                    class="flex items-center justify-between w-full px-8 py-4 transition-all duration-300 accordion hover:bg-sky-800">
                    <span class="text-lg"><i class="fa-solid fa-table"></i> Tables</span>
                    <i class="text-lg transition-transform duration-300 fa-solid fa-chevron-down"></i>
                </button>

                <div class="overflow-hidden text-lg transition-all duration-300 accordion-content">

                    <a href="" class="block w-full px-8 py-2 transition-all duration-300 hover:bg-sky-800">
                        <i class="fa-regular fa-circle"></i> Data Ikan
                    </a>
                    <a href="" class="block w-full px-8 py-2 transition-all duration-300 hover:bg-sky-800">
                        <i class="fa-regular fa-circle"></i> Data Anda
                    </a>

                </div>

            </div>

        </aside>

        <div class="ml-0 grow" id="content">

            <header class="flex w-full gap-12 py-6 text-lg h-fit bg-slate-100">
                <div class="px-8">
                    <a href="#" id="hambuger"><i class="fa-solid fa-bars"></i></a>
                </div>
                <nav class="flex gap-8">
                    <ul class="flex items-center justify-center gap-12">
                        <li>
                            <a href="/"
                                class="flex flex-col items-center justify-center transition-all duration-300 hover:text-sky-500 group {{ request()->routeIs('beranda') ? 'active' : '' }}">
                                Beranda
                                <hr class="w-0 transition-all duration-500 group-hover:border-sky-500 group-hover:w-full">
                            </a>
                        </li>
                        <li>
                            <a href="/profil"
                                class="flex flex-col items-center justify-center transition-all duration-300 hover:text-sky-500 group {{ request()->routeIs('profil') ? 'active' : '' }}">
                                Profil
                                <hr class="w-0 transition-all duration-500 group-hover:border-sky-500 group-hover:w-full">
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="flex flex-col items-center justify-center transition-all duration-300 hover:text-sky-500 group">
                                Peta Interaktif
                                <hr class="w-0 transition-all duration-500 group-hover:border-sky-500 group-hover:w-full">
                            </a>
                        </li>
                        <li>
                            <a href="/contact-us"
                                class="flex flex-col items-center justify-center transition-all duration-300 hover:text-sky-500 group {{ request()->routeIs('contact') ? 'active' : '' }}">
                                Kontak Kami
                                <hr class="w-0 transition-all duration-500 group-hover:border-sky-500 group-hover:w-full">
                            </a>
                        </li>
                    </ul>
            </header>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus facere unde, deleniti, atque suscipit reprehenderit similique commodi magni id autem velit quis adipisci explicabo rerum, laborum perferendis voluptas aperiam quae.</p>
            @yield('content')
        </div>

    </div>




    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const accordions = document.querySelectorAll('.accordion');

        accordions.forEach(acc => {
            acc.addEventListener('click', function () {
                var panel = this.nextElementSibling;
                console.log(panel)
                if(panel.style.maxHeight) {
                    panel.style.maxHeight = null;
                    this.classList.toggle('active')
                } else {
                    panel.style.maxHeight = panel.scrollHeight + 'px';
                    this.classList.toggle('active')
                    // this.classList.remove('active')
                }
            });
        });

        const sidebar = document.querySelector('#sidebar');
        const content = document.querySelector('#content');
        const hambuger = document.querySelector("#hambuger")

        hambuger.addEventListener('click', () => {
            sidebar.classList.toggle("-translate-x-full")
            sidebar.classList.toggle("content-shifted")
            hambuger.classList.toggle("hamburger-active")
        });


    </script>
    @stack('script')
</body>

</html>
