@extends('layouts.app')

@section('content')
    <section id="hero" class="-z-[999] relative h-screen bg-[url(/public/img/bg.svg)] bg-cover bg-left-bottom shadow-xl">
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
                    class="relative flex items-center justify-center h-10 overflow-hidden text-white transition-all bg-white rounded-full shadow-2xl cursor-pointer w-52 before:absolute before:h-0 before:w-0 before:rounded-full before:bg-sky-300 before:duration-500 before:ease-out hover:shadow-sky-300 hover:before:h-56 hover:before:w-56">
                    <span class="relative z-10 font-bold text-slate-900">Mulai Sekarang!</span>
                </a>
            </div>
            <div class="w-full mx-4 lg:w-1/2">
                <img id="heroImage" src="{{ asset('img/hero/img.svg') }}" alt="img-hero"
                    class="w-screen md:px-20 lg:px-0 animate-slide-left">
            </div>
        </div>
    </section>

    {{-- About Us --}}
    <section id="tentang-kami" class="pt-32 pb-16 bg-sky-50 lg:px-12">
        <div class="flex flex-wrap items-center justify-center gap-6 px-6 lg:px-28 lg:flex-nowrap">
            <div class="w-full lg:w-1/2 lg:mr-14" id="img-tentang-kami">
                <div
                    class="w-full h-[600px] bg-[url('/public/img/about/img.jpg')] bg-cover bg-center rounded-xl transition-all duration-300 shadow-xl hover:shadow-2xl">
                </div>
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

    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path fill="#f0f9ff" fill-opacity="1"
            d="M0,0L24,16C48,32,96,64,144,80C192,96,240,96,288,80C336,64,384,32,432,64C480,96,528,192,576,234.7C624,277,672,267,720,224C768,181,816,107,864,80C912,53,960,75,1008,112C1056,149,1104,203,1152,202.7C1200,203,1248,149,1296,154.7C1344,160,1392,224,1416,256L1440,288L1440,0L1416,0C1392,0,1344,0,1296,0C1248,0,1200,0,1152,0C1104,0,1056,0,1008,0C960,0,912,0,864,0C816,0,768,0,720,0C672,0,624,0,576,0C528,0,480,0,432,0C384,0,336,0,288,0C240,0,192,0,144,0C96,0,48,0,24,0L0,0Z">
        </path>
    </svg>

    {{-- Fitur Section --}}
    <section id="fitur" class="px-6 py-32 lg:px-32">
        <div class="flex flex-col gap-12">
            <h2 class="text-3xl font-bold">Fitur Yang Kami Hadirkan</h2>

            <div class="flex flex-wrap gap-6 lg:flex-nowrap">

                <x-fitur_card img="map.svg" judul="Peta Interaktif">
                    Eksplorasi peta digital yang menampilkan sebaran titik potensial penangkapan ikan.
                </x-fitur_card>
                <x-fitur_card img="verified.svg" judul="Data Terverifikasi">
                    Proses verifikasi data yang dilakukan oleh admin untuk memastikan keakuratan informasi.
                </x-fitur_card>

            </div>
            <div class="flex flex-wrap gap-6 lg:flex-nowrap">

                <x-fitur_card img="comunity.svg" judul="Komunitas">
                    Forum interaktif bagi para nelayan pengguna FinFinder, Pengguna bisa membagi titik potensial
                    penangkapan ikan.
                </x-fitur_card>
                <x-fitur_card img="add.svg " judul="Menambah Data">
                    Fitur yang memungkinkan pengguna untuk berkontribusi dengan menambahkan data baru tentang titik
                    potensial penangkapan ikan.
                </x-fitur_card>

            </div>
    </section>

    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path fill="#f0f9ff" fill-opacity="1"
            d="M0,192L24,170.7C48,149,96,107,144,128C192,149,240,235,288,277.3C336,320,384,320,432,282.7C480,245,528,171,576,160C624,149,672,203,720,192C768,181,816,107,864,69.3C912,32,960,32,1008,69.3C1056,107,1104,181,1152,181.3C1200,181,1248,107,1296,112C1344,117,1392,203,1416,245.3L1440,288L1440,320L1416,320C1392,320,1344,320,1296,320C1248,320,1200,320,1152,320C1104,320,1056,320,1008,320C960,320,912,320,864,320C816,320,768,320,720,320C672,320,624,320,576,320C528,320,480,320,432,320C384,320,336,320,288,320C240,320,192,320,144,320C96,320,48,320,24,320L0,320Z">
        </path>
    </svg>

    {{-- Timeline Section --}}
    <section id="timeline" class="pt-32 pb-16 bg-sky-50 lg:px-32">
        <div class="flex flex-col items-center justify-center px-8">
            <h2 class="mb-4 text-3xl font-bold text-center">Cara Kerja FinFinder</h2>
            <p class="text-center">Temukan titik potensial penangkapan ikan dengan mudah melalui empat langkah sederhana
                di FinFinder.</p>
        </div>
        <div
            class="relative max-w-[1200px] lg:my-24 mx-auto after:content-[''] after:absolute after:w-1 after:h-full after:bg-slate-900 after:top-0 lg:after:left-1/2 after:-m-[2px] my-12 after:left-[31px]">

            <x-card-timeline :isRight="false" img="user.svg" judul="Register FinFinder">
                Bergabunglah dengan komunitas FinFinder untuk akses ke berbagai fitur dan informasi penangkapan ikan.
            </x-card-timeline>
            <x-card-timeline :isRight="true" img="upload.svg" judul="Tambah Data">
                Bagikan pengalaman Anda dengan menambahkan lokasi potensial penangkapan ikan untuk membantu sesama nelayan.
            </x-card-timeline>
            <x-card-timeline :isRight="false" img="verified.svg" judul="Verifikasi Data">
                Data yang Anda bagikan akan diverifikasi untuk memastikan keakuratan informasi bagi komunitas.
            </x-card-timeline>
            <x-card-timeline :isRight="true" img="map.svg" judul="Jelajahi Data">
                Akses peta interaktif untuk menemukan lokasi terbaik dan informasi lengkap tentang titik penangkapan ikan.
            </x-card-timeline>

        </div>
    </section>

    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path fill="#f0f9ff" fill-opacity="1"
            d="M0,64L24,74.7C48,85,96,107,144,138.7C192,171,240,213,288,224C336,235,384,213,432,181.3C480,149,528,107,576,101.3C624,96,672,128,720,154.7C768,181,816,203,864,192C912,181,960,139,1008,106.7C1056,75,1104,53,1152,64C1200,75,1248,117,1296,128C1344,139,1392,117,1416,106.7L1440,96L1440,0L1416,0C1392,0,1344,0,1296,0C1248,0,1200,0,1152,0C1104,0,1056,0,1008,0C960,0,912,0,864,0C816,0,768,0,720,0C672,0,624,0,576,0C528,0,480,0,432,0C384,0,336,0,288,0C240,0,192,0,144,0C96,0,48,0,24,0L0,0Z">
        </path>
    </svg>

    {{-- Why Use This Section --}}
    <section id="why-use" class="px-6 py-12 pb-20 lg:px-32">
        <h2 class="mb-12 text-3xl font-bold text-center">Mengapa Memilih FinFinder</h2>

        <div class="flex flex-wrap justify-center gap-8 lg:flex-nowrap lg:justify-normal">

            <x-card-use title="Peta Interaktif">
                <x-slot:icon>
                    <div class="w-24 h-24 rounded-full p-[18px] bg-sky-200">
                        <svg width="381" height="380" viewBox="0 0 381 380" fill="none"
                            xmlns="http://www.w3.org/2000/svg" class="w-full h-full">
                            <path
                                d="M130.751 0.781006C129.339 1.37531 101.109 13.8561 67.9755 28.5655C3.93738 57.0187 2.60016 57.7616 0.891482 63.4819C0.222871 65.7106 0 103.227 0 217.857C0 368.592 0 369.26 1.4858 372.381C3.7888 376.987 8.02334 379.661 13.2979 379.735C17.161 379.735 21.247 378.027 76.296 353.511C108.612 339.173 135.431 327.361 135.802 327.361C136.174 327.361 162.844 339.099 195.086 353.437C248.872 377.432 254.072 379.587 257.936 379.661C262.096 379.735 263.433 379.141 317.962 351.877C356.073 332.858 374.571 323.275 376.131 321.64C377.394 320.377 378.88 318.149 379.326 316.812C380.069 314.954 380.292 278.478 380.292 162.511L380.366 10.5873L378.806 7.31854C376.503 2.63824 372.342 0.112396 366.919 0.112396C362.759 0.112396 360.902 0.929565 310.013 26.3368L257.416 52.5613L198.801 26.4854C156.827 7.83856 139.22 0.335266 136.768 0.0380859C134.837 -0.110474 132.237 0.186676 130.751 0.781006ZM122.579 168.677C122.579 274.986 122.356 302.845 121.687 303.365C120.944 303.959 32.4648 343.407 28.3789 344.968C27.636 345.265 27.4874 318.372 27.636 210.799L27.8588 76.1855L74.2902 55.4586C99.846 44.0922 121.167 34.7316 121.687 34.7316C122.356 34.6573 122.579 61.9218 122.579 168.677ZM197.463 55.5329L244.415 76.4084V210.874C244.415 335.607 244.34 345.339 243.152 344.893C242.483 344.596 221.088 335.161 195.606 323.869L149.323 303.365V169.048C149.323 95.1296 149.546 34.6573 149.918 34.6573C150.215 34.6573 171.61 44.0179 197.463 55.5329ZM352.878 169.717V303.959L312.39 324.241L271.902 344.448V210.131V75.8884L312.242 55.6815C334.38 44.5379 352.581 35.4745 352.73 35.4745C352.804 35.4002 352.878 95.7982 352.878 169.717Z"
                                class="fill-sky-500" />
                        </svg>

                    </div>
                </x-slot:icon>
                Temukan titik potensial penangkapan ikan dengan mudah
            </x-card-use>

            <x-card-use title="Data Terverifikasi">
                <x-slot:icon>
                    <div class="w-24 h-24 bg-indigo-200 rounded-full p-[18px]">
                        <svg width="343" height="358" viewBox="0 0 343 358" fill="none"
                            xmlns="http://www.w3.org/2000/svg" class="w-full h-full">
                            <path
                                d="M164.851 0.793854C154.212 3.75345 145.413 10.3125 134.055 23.8307C131.975 26.3903 128.696 29.4299 126.936 30.6297C124.136 32.4695 123.016 32.7094 117.577 32.6295C113.818 32.5495 108.538 31.7496 103.579 30.3898C96.5401 28.47 94.6204 28.2301 86.7815 28.55C74.2232 29.11 67.7441 31.6696 62.3848 38.0687C54.9458 47.0275 51.9863 55.5063 50.5464 71.984C50.0665 76.7834 49.1066 82.7025 48.3068 85.1022C47.0269 88.7817 46.1471 89.9016 42.3876 92.5412C39.9879 94.221 34.7886 96.8606 30.7892 98.3804C17.351 103.66 10.7919 108.459 4.39282 117.898C0.793314 123.097 0.553347 123.977 0.153402 129.576C-0.486509 140.295 2.23312 149.893 8.95219 160.132C14.3114 168.211 17.911 177.25 17.1111 180.609C16.3912 184.129 11.5918 194.527 9.27214 197.487C3.99287 204.446 0.793314 213.724 0.233391 223.723C-0.246543 231.322 -0.166554 231.722 2.23312 236.601C7.03245 246.36 17.0311 254.599 29.8293 259.478C38.948 262.918 46.1471 267.637 47.5869 271.077C49.4266 275.396 50.2265 280.115 51.1064 290.434C52.1462 303.872 55.7457 312.911 63.1047 320.59C70.9436 328.909 86.7815 331.468 103.579 327.069C108.298 325.869 114.058 324.989 117.657 324.909C124.856 324.749 126.456 325.709 134.055 334.508C146.373 348.586 154.052 354.025 165.731 356.825C170.69 358.025 171.49 358.025 176.369 356.825C188.127 353.865 196.206 348.026 208.285 333.708C210.364 331.148 213.644 328.109 215.404 326.909C218.283 324.989 219.323 324.749 224.762 324.909C228.522 324.989 234.041 325.869 238.84 327.149C245.799 329.069 247.719 329.309 255.558 328.989C271.636 328.269 278.435 324.269 285.074 311.551C288.914 304.352 290.273 298.913 291.073 288.274C291.473 283.235 292.353 276.916 293.153 274.116C294.513 269.397 294.913 268.837 299.392 265.797C302.032 264.038 307.471 261.238 311.55 259.638C315.63 257.958 320.669 255.639 322.829 254.359C328.108 251.319 336.587 242.521 339.467 237.241C341.706 233.082 341.706 232.762 341.306 224.043C340.906 214.044 339.147 208.045 334.747 201.086C330.188 193.807 327.308 188.128 325.948 183.249C324.669 178.929 324.669 178.369 325.948 174.53C327.548 169.571 330.668 163.171 333.147 159.972C338.507 152.853 342.346 140.775 342.346 131.176C342.346 126.377 341.946 124.617 339.867 120.457C335.387 111.419 324.589 102.38 313.87 98.7003C307.231 96.3807 299.712 92.5412 296.912 90.0616C294.033 87.3419 292.193 80.3829 291.153 67.5846C290.033 53.9865 286.274 44.7078 278.275 36.309C274.196 31.9896 264.517 29.03 254.358 29.03C250.199 28.95 245.32 29.3499 243.56 29.8298C241.8 30.2298 238.201 31.1897 235.561 31.9096C233.001 32.6295 228.042 33.1894 224.682 33.1894C219.243 33.1894 218.283 32.9494 215.404 30.8697C213.644 29.5899 210.444 26.4703 208.285 23.9907C196.366 9.9126 192.127 6.47308 182.368 2.55362C175.489 -0.166016 170.29 -0.645935 164.851 0.793854ZM174.689 26.7103C175.969 27.5102 182.048 33.4294 188.287 39.7485C197.486 49.1872 200.606 51.8268 205.245 54.2265C215.004 59.2658 226.602 59.9057 241.16 56.2262C248.439 54.4665 257.238 53.5066 260.277 54.3065C262.917 54.9464 264.357 59.6657 265.637 71.4241C266.917 84.2224 268.516 90.7014 271.876 97.6605C276.675 107.659 283.394 113.178 300.512 121.177C314.19 127.656 316.75 129.496 316.75 132.696C316.75 135.815 314.67 140.375 309.551 148.693C302.352 160.452 298.512 173.25 299.552 181.969C300.432 188.848 303.552 197.727 307.631 204.766C312.67 213.485 317.55 223.563 317.55 225.243C317.55 227.723 311.87 231.242 296.592 238.361C287.954 242.361 277.795 249.959 274.915 254.599C271.556 259.798 268.596 268.517 267.477 275.956C266.837 279.875 265.797 286.914 265.157 291.474C264.517 296.113 263.397 300.752 262.677 301.792C261.397 303.712 261.157 303.712 254.838 303.312C251.319 303.072 245.32 302.192 241.56 301.232C226.282 297.633 214.924 298.273 205.245 303.392C200.686 305.792 197.166 308.751 187.168 318.91C179.489 326.589 173.889 331.628 172.53 331.948C169.33 332.748 167.49 331.308 154.372 317.95C143.654 307.072 142.214 305.872 135.655 302.672L128.456 299.153L119.257 299.233C112.938 299.313 107.419 299.873 101.979 301.072C97.58 302.032 91.0209 303.072 87.4214 303.312L80.7823 303.792L79.5824 300.992C78.9425 299.393 77.8227 293.713 77.1828 288.274C75.1031 272.676 73.8232 266.837 70.7037 260.358C65.9043 250.119 59.3452 244.6 42.5476 236.681C28.2295 229.882 25.5899 228.042 25.5899 224.923C25.5899 222.523 29.2694 214.604 34.0687 206.765C39.9879 197.167 43.7474 183.569 42.7875 175.57C41.9076 168.691 38.7881 159.812 34.7086 152.773C29.6693 144.054 24.79 133.975 24.79 132.296C24.79 129.816 30.4692 126.297 45.7471 119.178C54.3859 115.178 64.5445 107.579 67.4241 102.94C70.7837 97.7405 73.7432 89.0217 74.8631 81.5827C75.503 77.5833 76.5429 70.6242 77.1828 66.0648C77.8227 61.4255 78.9425 56.7861 79.6624 55.7463C80.9423 53.8265 81.1822 53.8265 87.5014 54.2265C91.0209 54.4665 97.26 55.4263 101.179 56.4662C106.779 57.826 110.538 58.2259 117.977 58.2259C133.495 58.1459 138.614 55.5063 154.372 39.3485C168.85 24.6306 170.21 23.7507 174.689 26.7103Z"
                                class="fill-indigo-500" />
                            <path
                                d="M223.963 128.376C222.843 128.856 206.205 144.934 187.008 164.211L151.973 199.166L139.014 186.208C125.016 172.37 123.656 171.49 117.017 172.77C113.098 173.49 108.299 178.289 107.579 182.209C106.219 189.168 106.619 189.648 127.016 210.125C143.254 226.362 146.373 229.162 149.013 229.562C156.372 230.922 154.532 232.522 199.006 188.128C228.442 158.692 240.2 146.454 240.84 144.454C242.6 139.095 240.68 133.335 235.801 129.736C233.321 127.896 226.922 127.176 223.963 128.376Z"
                                class="fill-indigo-500" />
                        </svg>
                    </div>
                </x-slot:icon>
                Data sudah terverifikasi oleh admin
            </x-card-use>

            <x-card-use title="Mudah Digunakan">
                <x-slot:icon>
                    <div class="w-24 h-24 rounded-full p-[18px] bg-fuchsia-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-full h-full bi bi-lightbulb" viewBox="0 0 16 16">
                            <path
                                d="M2 6a6 6 0 1 1 10.174 4.31c-.203.196-.359.4-.453.619l-.762 1.769A.5.5 0 0 1 10.5 13a.5.5 0 0 1 0 1 .5.5 0 0 1 0 1l-.224.447a1 1 0 0 1-.894.553H6.618a1 1 0 0 1-.894-.553L5.5 15a.5.5 0 0 1 0-1 .5.5 0 0 1 0-1 .5.5 0 0 1-.46-.302l-.761-1.77a2 2 0 0 0-.453-.618A5.98 5.98 0 0 1 2 6m6-5a5 5 0 0 0-3.479 8.592c.263.254.514.564.676.941L5.83 12h4.342l.632-1.467c.162-.377.413-.687.676-.941A5 5 0 0 0 8 1"
                                class="fill-fuchsia-500" />
                        </svg>

                    </div>
                </x-slot:icon>
                Gratis dan simpel digunakan untuk semua nelayan
            </x-card-use>

        </div>
    </section>
@endsection

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const heroImage = document.getElementById('heroImage');

            // Tambahkan animasi slide saat halaman dimuat
            heroImage.classList.add('animate-slide-left');

            // Tambahkan animasi motion setelah 2 detik
            setTimeout(() => {
                heroImage.classList.add('animate-motion');
            }, 1000);
        });
    </script>
@endpush
