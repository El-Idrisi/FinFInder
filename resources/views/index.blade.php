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

<body class="relative font-inter -z-[9999]  overflow-x-hidden">
    <x-navbar></x-navbar>

    <section id="hero" class="-z-[999] relative h-screen bg-[url(/public/img/bg.svg)] bg-cover bg-left-bottom">
        <div
            class="absolute z-30 flex flex-col-reverse items-center justify-center px-8 -translate-y-1/2 top-1/2 text-slate-100 lg:flex-nowrap lg:flex-row lg:px-32 md:px-16 ">
            <div class="w-full mx-4 mt-8 lg:w-1/2 animate-slide-right">
                <h3 class="my-2 text-xl font-bold lg:text-3xl md:text-2xl">FinFinder</h3>
                <h1 class="my-2 text-3xl font-bold lg:text-6xl md:text-4xl">Temukan Titik Potensial Penangkapan Ikan
                </h1>
                <p class="my-4">FinFinder adalah platform inovatif yang dirancang khusus untuk komunitas
                    nelayan.
                </p>
                <a href="#"
                    class="px-8 py-2 my-2 font-semibold rounded-full cursor-pointer bg-slate-100 text-sky-500">Gabung
                    Sekarang</a>
            </div>
            <div class="w-full mx-4 lg:w-1/2">
                <img src="{{ asset('img/hero/img.svg') }}" alt="img-hero" class="w-screen md:px-20 lg:px-0 animate-slide-left">
            </div>
        </div>
    </section>

    {{-- About Us --}}
    <section id="tentang-kami" class="pt-32 pb-16 bg-sky-50 lg:px-12">
        <div class="flex flex-wrap items-center justify-center gap-6 px-28 lg:flex-nowrap">
            <div class="w-full lg:w-1/2 lg:mr-14" id="img-tentang-kami">
                <img src="{{ asset('img/about/img.jpg') }}" alt="raja-ampat" class="rounded-xl h-[600px] shadow-xl" loading="lazy">
            </div>
            <div class="w-full lg:w-1/2 lg:ml-14">
                <h2 class="mb-12 text-3xl font-bold">Tentang Kami</h2>
                <p class="mt-6 mb-12 text-xl text-justify">
                    FinFinder adalah aplikasi inovatif yang kami kembangkan untuk membantu nelayan.
                    Dengan menggunakan teknologi pemetaan digital terkini, kami menyediakan informasi
                    tentang lokasi potensial penangkapan ikan. Tujuan kami adalah meningkatkan efisiensi
                    operasi nelayan untuk menemukan titik potensial ikan.
                </p>
                <p class="mt-6 text-xl text-justify">
                    Diluncurkan pada tahun 2024, FinFinder diciptakan untuk mempermudah nelayan dengan
                    teknologi pemetaan interaktif yang mudah digunakan. Aplikasi ini menyajikan informasi
                    tentang titik potensial ikan yang telah diinput oleh nelayan. Kami yakin dengan
                    menyediakan peta interaktif dan sistem verifikasi data, kita dapat membantu
                    nelayan menemukan titik potensial penangkapan ikan secara efisien.
                </p>
            </div>
        </div>

    </section>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#f0f9ff" fill-opacity="1" d="M0,0L24,16C48,32,96,64,144,80C192,96,240,96,288,80C336,64,384,32,432,64C480,96,528,192,576,234.7C624,277,672,267,720,224C768,181,816,107,864,80C912,53,960,75,1008,112C1056,149,1104,203,1152,202.7C1200,203,1248,149,1296,154.7C1344,160,1392,224,1416,256L1440,288L1440,0L1416,0C1392,0,1344,0,1296,0C1248,0,1200,0,1152,0C1104,0,1056,0,1008,0C960,0,912,0,864,0C816,0,768,0,720,0C672,0,624,0,576,0C528,0,480,0,432,0C384,0,336,0,288,0C240,0,192,0,144,0C96,0,48,0,24,0L0,0Z"></path></svg>


    <section id="fitur" class="py-32 lg:px-12">

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
