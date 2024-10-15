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

<body class="relative font-inter -z-[9999] overflow-x-hidden bg-sky-50">

    <aside id="sidebar" class="h-full w-[240px] bg-white transition-all duration-300 fixed top-0 bottom-0 shadow-lg">
        <div class="px-12 py-4">
            <img src="{{ asset('img/finfinder.png') }}" alt="logo finfinder">
        </div>

        <div class="px-4 font-bold text-gray-400">
            <h4 class="text-sm">Menu</h4>
            <div class="flex flex-col gap-6 mt-4 ml-4">
                <a href="/dashboard" class="flex items-center gap-4 transition-all duration-300 hover:text-sky-500">
                    <img src="{{ asset('img/sidebar/Group 133.svg') }}" alt="dashboard-icon" class="scale-125">
                    Dashboards
                </a>
                <a href="/" class="flex items-center gap-4 transition-all duration-300 hover:text-sky-500" >
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
                <a href="#" class="flex items-center gap-4 transition-all duration-300 hover:text-sky-500" >
                    <img src="{{ asset('img/sidebar/Group 137.svg') }}" alt="dashboard-icon" class="scale-125">
                    Your Data
                </a>
            </div>
        </div>

        <div class="px-4 mt-8 font-bold text-gray-400">
            <h4 class="text-sm">Notifications</h4>
            <div class="flex flex-col gap-6 mt-4 ml-4">
                <a href="#" class="flex items-center gap-4 transition-all duration-300 hover:text-sky-500">
                    <img src="{{ asset('img/sidebar/Group 138.svg') }}" alt="dashboard-icon" class="scale-125">
                    Notifications
                </a>
            </div>
        </div>

        <div class="px-4 mt-8 font-bold">
            <a href="#" class="px-[3.5rem] py-2 text-white bg-gradient-to-r from-violet-400    via-sky-500 to-fuchsia-400 rounded-md bg-size-200 bg-pos-0 transition-all duration-300 hover:bg-pos-100">
                <span class="shad"><i class="fa-solid fa-plus"></i> Add Data</span>
            </a>
        </div>

    </aside>
    {{-- <div class="flex w-full h-full">


    </div> --}}

    <div class="content-shifted ml-[240px]" id="content">
        <header class="flex justify-between w-full gap-12 px-8 text-lg bg-white shadow-lg h-fit">
            <div class="py-6">
                <a href="#" id="hambuger"><i class="fa-solid fa-bars"></i></a>
            </div>
            <div class="relative flex">
                <button
                    class="flex items-center justify-between w-full gap-[0.8rem] px-8 transition-all duration-300 accordion hover:bg-sky-200 bg-slate-100">
                    <span class="text-lg"><i class="mr-1 text-lg fa-solid fa-user"></i>
                        {{ Auth::user()->username }}</span>
                    <i class="text-lg transition-transform duration-300 fa-solid fa-chevron-down"></i>
                </button>

                <div class="absolute flex flex-col overflow-hidden text-lg transition-all duration-300 bg-white top-[4.7rem] accordion-content shadow-lg rounded-b-lg">
                    <a href="" class="block w-full px-8 py-2 transition-all duration-300 hover:bg-sky-300"><i
                            class="fa-solid fa-gear"></i>
                        Settings</a>
                    <a
                        class="block w-full px-8 py-2 transition-all duration-300 list-group-item logout hover:bg-sky-300">
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
        </header>


        @yield('content')
    </div>



    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const accordions = document.querySelectorAll('.accordion');

        accordions.forEach(acc => {
            acc.addEventListener('click', function() {
                var panel = this.nextElementSibling;
                console.log(panel)
                if (panel.style.maxHeight) {
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
            content.classList.toggle("ml-[240px]")
            hambuger.classList.toggle("hamburger-active")
        });
    </script>
    @stack('script')
</body>

</html>
