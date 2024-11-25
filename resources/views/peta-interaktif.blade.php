<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/gokertanrisever/leaflet-ruler@master/src/leaflet-ruler.css"
        integrity="sha384-P9DABSdtEY/XDbEInD3q+PlL+BjqPCXGcF8EkhtKSfSTr/dS5PBKa9+/PMkW2xsY" crossorigin="anonymous" />

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>


    <script src="https://cdn.jsdelivr.net/gh/gokertanrisever/leaflet-ruler@master/src/leaflet-ruler.js"
        integrity="sha384-8SqKZR7V8uOetpjjbcNJHvwuHpb074WS0UXjCLhzfJUqYn3B/uWx1WVv5mwRp1mV" crossorigin="anonymous">
    </script>

    <script src="https://kit.fontawesome.com/bd2b93a447.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="{{ asset('icon/favicon.ico') }}" type="image/x-icon">
    @vite('resources/css/app.css')
    <title>FinFinder | Peta Interaktif</title>
    <style>
        ul li {
            list-style: disc;
            list-style-position: inside;
        }

        ol li {
            list-style: decimal;
            list-style-position: inside;
        }

        ol li *,
        ul li * {
            display: inline !important;
        }

        .leaflet-layer.dark,
        .leaflet-control-zoom-in.dark,
        .leaflet-control-zoom-out.dark,
        .leaflet-control-attribution.dark,
        .leaflet-control.leaflet-ruler.dark {
            filter: invert(100%) hue-rotate(180deg) brightness(95%) contrast(90%);
        }

        .leaflet-layer,
        .leaflet-control-zoom-in,
        .leaflet-control-zoom-out,
        .leaflet-control-attribution,
        .leaflet-control.leaflet-ruler {
            transition: all 0.3s;
        }

        /* Style untuk popup Leaflet */
        .leaflet-popup.dark .leaflet-popup-content-wrapper {
            background-color: #1f2937;
            /* Warna background dark */
            color: white;
        }

        .leaflet-popup.dark .leaflet-popup-tip {
            background-color: #1f2937;
            /* Warna tip/arrow dark */
        }

        /* Optional: Style untuk link dalam popup */
        .leaflet-popup.dark .leaflet-popup-content a {
            color: #60a5fa;
            /* Warna link saat dark mode */
        }

        /* Optional: Hover state untuk close button */
        .leaflet-popup.dark .leaflet-popup-close-button {
            color: white;
        }

        .leaflet-popup.dark .leaflet-popup-close-button:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
    </style>
</head>

<body class="font-inter">

    <header class="w-full px-8 py-2 transition-all duration-300 shadow-lg dark:bg-slate-900">
        <div class="flex items-center justify-between">
            <img src="{{ asset('img/finfinder.png') }}" alt="logo" class="w-32">
            <ul class="hidden gap-8 lg:flex">
                <li class="list-none">
                    <a href="{{ route('beranda') }}"
                        class="!flex flex-col items-center justify-center transition-all duration-300 hover:text-sky-500 group dark:text-slate-100">
                        Beranda
                        <hr class="w-0 duration-500 group-hover:border-sky-500 group-hover:w-full group-hover:border">
                    </a>
                </li>
                <li class="list-none">
                    <a href="{{ route('profil') }}"
                        class="!flex flex-col items-center justify-center transition-all duration-300 hover:text-sky-500 group dark:text-slate-100">
                        Profil
                        <hr class="w-0 duration-500 group-hover:border-sky-500 group-hover:w-full group-hover:border">
                    </a>
                </li>
                <li class="list-none">
                    <a href="{{ route('peta-interaktif') }}"
                        class="!flex flex-col text-sky-500 font-bold    items-center justify-center transition-all duration-300 hover:text-black group dark:hover:text-slate-100">
                        Peta Interaktif
                        <hr
                            class="w-0 duration-500 group-hover:border-black group-hover:w-full group-hover:border dark:group-hover:border-slate-100">
                    </a>
                </li>
                <li class="list-none">
                    <a href="{{ route('contact') }}"
                        class="!flex flex-col items-center justify-center transition-all duration-300 hover:text-sky-500 group dark:text-slate-100">
                        Kontak Kami
                        <hr class="w-0 duration-500 group-hover:border-sky-500 group-hover:w-full group-hover:border">
                    </a>
                </li>
            </ul>
            <div class="flex gap-4">
                <button id="dark-btn" class="dark:text-slate-100">
                    <i class="text-2xl transition-all duration-300 fa-solid fa-moon hover:text-sky-500"></i>
                    <i class="hidden text-2xl transition-all duration-300 fa-solid fa-sun hover:text-sky-500"></i>
                </button>
                <button id="dark-btn" class="dark:text-slate-100">
                    <a href="#" class="text-2xl group "><i
                            class="transition-all duration-300 fa-solid fa-list group-hover:text-sky-500"></i></a>
                    <button id="dark-btn" class="dark:text-slate-100">
                        <a href="#" class="text-2xl group "><i
                                class="transition-all duration-300 fa-solid fa-layer-group group-hover:text-sky-500"></i></a>
            </div>
        </div>
    </header>

    <div id="map" class="h-[calc(100vh-58px)] w-100 bg-slate-200"></div>

    <script>
        var map = L.map('map').setView([1.3848069459548475, 102.18214794585786], 10);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        map.on('popupopen', function(e) {
            if (document.body.classList.contains('dark')) {
                e.popup.getElement().classList.add('dark');
            } else {
                e.popup.getElement().classList.remove('dark');
            }
        });

        var options = {
            position: 'topleft',
            lengthUnit: {
                display: 'km',
                decimal: 2,
                factor: null,
                label: 'Jarak:'
            },
            angleUnit: {
                display: '&deg;',
                decimal: 2, 
                factor: null,
                label: 'Bearing:'
            }
        };

        L.control.ruler(options).addTo(map);

        var spots = @json($spots);
        console.log(spots);

        spots.forEach(function(spot) {
            let fishArray = spot.fishes;

            const fishesHTML = Array.isArray(fishArray) ?
                fishArray.map(fish => {
                    return `
                        <span class="p-1 transition-all duration-300 border rounded w-fit border-sky-300 hover:bg-sky-300">
                            ${fish}
                        </span>
                    `;
                }).join('') :
                '';

            L.marker([spot.latitude, spot.longitude]).addTo(map)
                .bindPopup(`
                    <div class="mb-4">
                        <h4 class="font-bold text-md">Detail Data</h4>
                    </div>
                    <div class="flex flex-wrap gap-1 mb-4">
                        ${fishesHTML}
                    </div>
                    <div class="mb-4">
                        ${spot.deskripsi}
                    </div>
                    <div class="border-t border-slate-200">
                        <p class="italic text-gray-400">Created by <span class="not-italic font-bold">${spot.owner}</span></p>
                    </div>
                `);
        });
    </script>

    <script>
        const darkBtn = document.getElementById('dark-btn');
        darkBtn.addEventListener('click', function() {
            document.body.classList.toggle('dark');

            // Toggle dark mode untuk elemen Leaflet
            const openPopup = document.querySelector('.leaflet-popup');
            console.log(openPopup);
            if (openPopup) {
                openPopup.classList.toggle('dark');
            }
            document.querySelectorAll([
                '.leaflet-layer',
                '.leaflet-control-zoom-in',
                '.leaflet-control-zoom-out',
                '.leaflet-control-attribution',
                '.leaflet-control.leaflet-ruler',
                '.leaflet-popup-content-wrapper',
                '.leaflet-popup-tip',
            ].join(',')).forEach(el => {
                el.classList.toggle('dark');
            });

            // Toggle icon
            document.querySelector('.fa-moon').classList.toggle('hidden');
            document.querySelector('.fa-sun').classList.toggle('hidden');
        });
    </script>
</body>


</html>
