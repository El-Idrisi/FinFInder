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
    @vite('resources/css/app.css')
    <title>FinFinder | Home</title>
</head>

<body class="relative font-inter -z-[9999]">
    <header class="absolute top-0 flex items-center justify-around w-full h-20 transition-all duration-300 bg-transparent text-slate-100">
        <div class="navbar-brand">
            <a href="#">
                <img src="{{ asset('img/finfinder.png') }}" alt="FinFinder Logo"
                    class="w-[130px] grayscale transition-all duration-300 hover:grayscale-0">
            </a>
        </div>
        <nav id="navbar-list" class="hidden lg:block">
            <ul class="flex items-center justify-center gap-12">
                <li>
                    <a href="/"
                        class="flex flex-col items-center justify-center transition-all duration-300 hover:text-sky-500 group">
                        Beranda
                        <hr class="w-0 transition-all duration-500 group-hover:border-sky-500 group-hover:w-full">
                    </a>
                </li>
                <li>
                    <a href="#"
                        class="flex flex-col items-center justify-center transition-all duration-300 hover:text-sky-500 group">
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
                    <a href="#"
                        class="flex flex-col items-center justify-center transition-all duration-300 hover:text-sky-500 group">
                        Kontak Kami
                        <hr class="w-0 transition-all duration-500 group-hover:border-sky-500 group-hover:w-full">
                    </a>
                </li>
            </ul>
        </nav>
        <div class="items-center justify-center hidden gap-4 lg:flex">
            <a href="#"
                class="flex flex-col items-center justify-center transition-all duration-300 hover:text-sky-500 group">
                Login
                <hr class="w-0 transition-all duration-500 group-hover:border-sky-500 group-hover:w-full">
            </a>
            <a href="#"
                class="px-4 py-2 transition-all duration-300 rounded-lg bg-sky-500 text-slate-100 hover:bg-sky-600">Sign
                Up</a>
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
                    <a href="/" class="my-2 duration-300 ransition-all hover:text-sky-500">Beranda</a>
                    <a href="#" class="my-2 duration-300 ransition-all hover:text-sky-500">Profil</a>
                    <a href="#" class="my-2 duration-300 ransition-all hover:text-sky-500">Peta Interaktif</a>
                    <a href="#" class="my-2 duration-300 ransition-all hover:text-sky-500">Kontak Kami</a>
                </div>
                <div class="px-2 mt-6">
                    <a href="#" class="mx-2 duration-300 ransition-all hover:text-sky-500">
                        Login
                    </a>
                    <a href="#"
                        class="px-4 py-2 mx-2 transition-all duration-300 rounded-lg bg-sky-500 text-slate-100 hover:bg-sky-600">Sign
                        Up
                    </a>
                </div>
            </div>



        </nav>
    </header>

    <section id="hero" class="-z-[999] relative h-screen bg-[url(/public/img/bg.svg)] bg-cover bg-left-bottom">
        <div
            class="absolute z-30 flex flex-col-reverse items-center justify-center px-8 -translate-y-1/2 top-1/2 text-slate-100 lg:flex-nowrap lg:flex-row lg:px-32 md:px-16">
            <div class="w-full mx-4 mt-8 lg:w-1/2">
                <h3 class="my-2 text-xl font-bold lg:text-3xl md:text-2xl">FinFinder</h3>
                <h1 class="my-2 text-3xl font-bold lg:text-6xl md:text-4xl">Temukan Titik Potensial Penangkapan Ikan</h1>
                <p class="my-4">FinFinder adalah platform inovatif yang dirancang khusus untuk komunitas
                    nelayan.
                </p>
                <a href="#"
                    class="px-8 py-2 my-2 font-semibold rounded-full cursor-pointer bg-slate-100 text-sky-500">Gabung
                    Sekarang</a>
            </div>
            <div class="w-full mx-4 lg:w-1/2">
                <img src="{{ asset('img/hero/img.svg') }}" alt="img-hero" class="w-screen md:px-20 lg:px-0">
            </div>
        </div>
    </section>

    <section id="tentang-kami" class="py-32 lg:px-12">
        <div class="flex flex-wrap items-center justify-center gap-6 px-6 lg:flex-nowrap">
            <div class="w-full lg:w-1/2 lg:mr-14">
                <div class="w-full h-[680px] bg-slate-300"></div>
            </div>
            <div class="w-full lg:w-1/2 lg:ml-14">
                <h2 class="mb-12 text-3xl font-bold tracking-widest">Tentang Kami</h2>
                <p class="mt-6 mb-12 text-xl">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. </p>

                <p class="mt-6 text-xl">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque auctor mollis sem, ultrices condimentum turpis semper et. Morbi convallis, erat a cursus imperdiet, eros dolor sollicitudin odio, nec egestas turpis elit ac libero. Duis erat nibh, lacinia eu laoreet quis, sagittis sed metus. Fusce a sapien nec arcu posuere accumsan.</p>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const header = document.querySelector('header');

            window.onscroll = function() {
                const fixedNav = header.offsetTop;

                if (window.pageYOffset > fixedNav) {
                    header.classList.add('navbar-fixed');
                } else {
                    header.classList.remove('navbar-fixed');
                }

            }

            const hambuger = document.querySelector(".hamburger-icon")
            const navMenu = document.querySelector("#nav-menu")
            hambuger.addEventListener('click', () => {
                navMenu.classList.toggle("-translate-y-full")
                hambuger.classList.toggle("hamburger-active")
            });
        });
    </script>
</body>

</html>
