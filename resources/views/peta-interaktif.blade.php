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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet-easybutton@2/src/easy-button.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://cdn.jsdelivr.net/gh/gokertanrisever/leaflet-ruler@master/src/leaflet-ruler.js"
        integrity="sha384-8SqKZR7V8uOetpjjbcNJHvwuHpb074WS0UXjCLhzfJUqYn3B/uWx1WVv5mwRp1mV" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/leaflet-easybutton@2/src/easy-button.js"></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

    <script src="https://kit.fontawesome.com/bd2b93a447.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="{{ asset('icon/favicon.ico') }}" type="image/x-icon">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('css/map-interaktif.css') }}">
    <title>FinFinder | Peta Interaktif</title>
    <style>
        .leaflet-layer.dark,
        .leaflet-control-zoom-in.dark,
        .leaflet-control-zoom-out.dark,
        .leaflet-control-attribution.dark,
        .leaflet-control.leaflet-ruler.dark,
        .right-control-group.leaflet-control.dark,
        .easy-button-container.leaflet-control.dark,
        .leaflet-control-geocoder.dark {
            filter: invert(100%) hue-rotate(180deg) brightness(95%) contrast(90%) !important;
        }


        .leaflet-layer,
        .leaflet-control-zoom-in,
        .leaflet-control-zoom-out,
        .leaflet-control-attribution,
        .leaflet-control.leaflet-ruler,
        .easy-button-container.leaflet-control,
        .leaflet-control-geocoder {
            transition: all 0.3s;
        }
    </style>
</head>

<body class="font-inter">

    <header class="w-full px-12 py-2 transition-all duration-300 shadow-lg dark:bg-slate-900">
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
                </button>
                <button id="dark-btn" class="dark:text-slate-100">
                    <a href="#" class="text-2xl group "><i
                            class="transition-all duration-300 fa-solid fa-layer-group group-hover:text-sky-500"></i></a>
                </button>
            </div>
        </div>
    </header>

    <div id="map" class=" h-[calc(100vh-58px)]  w-100">
        <div id="basemapGallery"
            class="hidden rounded-lg border-2 border-slate-300 absolute p-4 bg-white-100 top-16 left-14 z-[999] dark:bg-slate-900 dark:border-slate-700 dark:text-white-100">
            <div id="basemapGalleryHeader" class="flex justify-between">
                <h4 class="text-base font-bold">BaseMap Gallery</h4>
                <button id="close-btn"><i class="fa-solid fa-x"></i></button>
            </div>
            <div class="grid grid-cols-2 gap-2 mt-4">
                <div class="text-center cursor-pointer ">
                    <a href="#" class="basemap-btn" data-basemap="osm">
                        <img src="{{ asset('img/basemap/osm.png') }}" alt=""
                            class="w-32 h-20 border-[3px] border-dashed rounded-lg border-slate-500 hover:opacity-80  transition-all duration-300">
                        <p class="mt-2 font-semibold text-black dark:text-white-100">Open Street Map</p>
                    </a>
                </div>
                <div class="text-center cursor-pointer ">
                    <a href="#" class="basemap-btn" data-basemap="satelite">
                        <img src="{{ asset('img/basemap/satelit.png') }}" alt=""
                            class="w-32 h-20 border-[3px] border-dashed rounded-lg border-slate-500 hover:opacity-80  transition-all duration-300">
                        <p class="mt-2 font-semibold text-black dark:text-white-100">Satelit</p>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Leaflet JS --}}
    <script src="{{ asset('js/func.js') }}"></script>
    <script>
        var map = L.map('map').setView([1.169060, 102.432404], 10);
        map.on('popupopen', function(e) {
            if (document.body.classList.contains('dark')) {
                e.popup.getElement().classList.add('dark');
            } else {
                e.popup.getElement().classList.remove('dark');
            }
        });
    </script>
    {{-- Leaflet JS --}}


    <script>
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

        // Ruler control
        const ruler = L.control.ruler(options).addTo(map);

        // Buat container untuk control sebelah kiri (zoom dan ruler)
        const leftControlContainer = L.DomUtil.create('div', 'left-control-group leaflet-control');

        // Buat container untuk control kanan (home dan layers)
        const rightControlContainer = L.DomUtil.create('div', 'right-control-group leaflet-control');


        var homeBtn = L.easyButton({
            states: [{
                stateName: 'home', // name the state
                icon: 'fa-home', // and define its properties
                title: 'home', // like its title
                onClick: function(btn, map) { // and its callback
                    map.setView([1.169060, 102.432404], 10);
                    btn.state('home'); // change state on click!
                }
            }]
        }).addTo(map);


        // Base maps control
        var layerControl = L.easyButton({
            states: [{
                stateName: 'basemap', // name the state
                icon: 'fa-map', // and define its properties
                title: 'basemap', // like its title
                onClick: function() { // and its callback
                    document.querySelector('#basemapGallery').classList.toggle('hidden');
                }
            }]
        }).addTo(map);

        // Base maps control
        let isEditable = false;
        let currentMarker = null;
        let mapClickHandler = null;
        let currentLine = null; // Tambahkan variabel untuk menyimpan referensi line

        var pointControl = L.easyButton({
            states: [{
                stateName: 'point-control',
                icon: 'fa-location-dot',
                title: 'Toggle Point Selection',
                onClick: function() {
                    isEditable = !isEditable;
                    console.log(currentMarker);

                    if (isEditable) {
                        mapClickHandler = function(e) {
                            const lat = e.latlng.lat;
                            const lng = e.latlng.lng;

                            // Hapus marker dan line sebelumnya jika ada
                            if (currentMarker) {
                                map.removeLayer(currentMarker);
                            }
                            if (currentLine) {
                                map.removeLayer(currentLine);
                            }

                            // Tambah marker baru
                            currentMarker = L.marker([lat, lng], {
                                icon: userIcon
                            }).addTo(map);
                            currentMarker.bindPopup(
                                "Latitude: " + lat.toFixed(6) +
                                "<br>Longitude: " + lng.toFixed(6)
                            ).openPopup();

                            const searchLocation = currentMarker._latlng;
                            // Cari titik terdekat dan gambar line
                            const nearestPoints = findNearestPoints(searchLocation);

                            // Simpan referensi line yang baru dibuat
                            if (nearestPoints && nearestPoints.length > 0) {
                                const nearestPoint = nearestPoints[0];
                                currentLine = L.polyline([
                                    searchLocation,
                                    [nearestPoint.spot.latitude, nearestPoint.spot
                                        .longitude
                                    ]
                                ], {
                                    color: '#2563eb',
                                    weight: 3,
                                    opacity: 0.8,
                                    dashArray: '10, 10'
                                }).addTo(map);

                                // Tambahkan popup dengan informasi jarak
                                currentLine.bindPopup(`
                                    <div class="text-center">
                                        <p class="font-bold">Jarak Terdekat: ${nearestPoint.distance.toFixed(2)} km</p>
                                        <p>Ke lokasi: ${nearestPoint.spot.description || 'Titik Terdekat'}</p>
                                    </div>
                                `).openPopup();
                            }
                        };

                        map.on('click', mapClickHandler);
                        pointControl.button.style.backgroundColor = '#93c5fd';

                    } else {
                        // Nonaktifkan mode dan bersihkan peta
                        if (mapClickHandler) {
                            map.off('click', mapClickHandler);
                            mapClickHandler = null;
                        }
                        if (currentMarker) {
                            map.removeLayer(currentMarker);
                            currentMarker = null;
                        }
                        if (currentLine) {
                            map.removeLayer(currentLine);
                            currentLine = null;
                        }

                        pointControl.button.style.backgroundColor = '';
                    }
                }
            }]
        }).addTo(map);

        var geocoder = L.Control.geocoder({
            defaultMarkGeocode: false // Jangan tambahkan marker otomatis
        }).addTo(map);

        // Handle ketika lokasi ditemukan
        geocoder.on('markgeocode', function(e) {
            const searchLocation = e.geocode.center; // Koordinat hasil pencarian

            // Hapus marker dan line sebelumnya jika ada
            if (currentMarker) {
                map.removeLayer(currentMarker);
            }
            if (currentLine) {
                map.removeLayer(currentLine);
            }
            // Tambahkan marker untuk lokasi yang dicari
            currentMarker = L.marker(searchLocation, {
                    icon: userIcon
                })
                .addTo(map)
                .bindPopup('Lokasi yang dicari')
                .openPopup();

            // Hitung jarak ke semua titik
            const nearestPoints = findNearestPoints(searchLocation);


            // Simpan referensi line yang baru dibuat
            if (nearestPoints && nearestPoints.length > 0) {
                const nearestPoint = nearestPoints[0];
                currentLine = L.polyline([
                    searchLocation,
                    [nearestPoint.spot.latitude, nearestPoint.spot
                        .longitude
                    ]
                ], {
                    color: '#2563eb',
                    weight: 3,
                    opacity: 0.8,
                    dashArray: '10, 10'
                }).addTo(map);

                // Tambahkan popup dengan informasi jarak
                currentLine.bindPopup(`
                    <div class="text-center">
                        <p class="font-bold">Jarak Terdekat: ${nearestPoint.distance.toFixed(2)} km</p>
                        <p>Ke lokasi: ${nearestPoint.spot.description || 'Titik Terdekat'}</p>
                    </div>
                `).openPopup();

                const bounds = L.latLngBounds([
                    searchLocation,
                    [nearestPoint.spot.latitude, nearestPoint.spot.longitude]
                ]);
                map.fitBounds(bounds, {
                    padding: [50, 50]
                });
            }
        });



        homeBtn.button.classList.add('custom-control-button');
        layerControl.button.classList.add('custom-control-button');

        // Pindahkan zoom control ke left container
        const zoomControl = map.zoomControl.getContainer();
        leftControlContainer.appendChild(zoomControl);

        // Pindahkan ruler ke left container
        const rulerControl = ruler.getContainer();
        leftControlContainer.appendChild(rulerControl);

        // Pindahkan home dan layers ke right container
        rightControlContainer.appendChild(homeBtn.getContainer());
        rightControlContainer.appendChild(layerControl.getContainer());
        rightControlContainer.appendChild(pointControl.getContainer());
        rightControlContainer.appendChild(geocoder.getContainer());

        // Tambahkan kedua container ke map
        const topLeftControls = map.getContainer().querySelector('.leaflet-top.leaflet-left');
        topLeftControls.appendChild(leftControlContainer);
        topLeftControls.appendChild(rightControlContainer);

        var spots = @json($spots);
        console.log(spots);

        var fishIcon = L.icon({
            iconUrl: 'https://api.geoapify.com/v1/icon/?type=material&color=%230ea5e9&icon=fish&iconType=awesome&apiKey=380779a6b2b24a899c67e7b3d7df04dc',
            iconSize: [30, 47], // size of the icon
            iconAnchor: [15, 42],
            popupAnchor: [0, -40],
        });
        var userIcon = L.icon({
            iconUrl: 'https://api.geoapify.com/v1/icon/?type=material&color=%23ef4444&icon=user&iconType=awesome&apiKey=380779a6b2b24a899c67e7b3d7df04dc',
            iconSize: [30, 47], // size of the icon
            iconAnchor: [15, 42],
            popupAnchor: [0, -40],
        });

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

            L.marker([spot.latitude, spot.longitude], {
                    icon: fishIcon
                }).addTo(map)
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

    {{-- Basemap Setting --}}
    <script>
        // Definisi basemap dan URL nya
        const basemapUrls = {
            osm: {
                url: 'https://tile.openstreetmap.org/{z}/{x}/{y}.png',
                options: {
                    maxZoom: 19,
                    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                }
            },
            satelite: {
                url: 'http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}',
                options: {
                    maxZoom: 20,
                    subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
                }
            },
            transport: {
                url: 'https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png',
                options: {
                    maxZoom: 19,
                    attribution: '&copy; OpenStreetMap contributors'
                }
            }
        };
        // Buat layer untuk peta utama
        var baseMaps = {
            osm: L.tileLayer(basemapUrls.osm.url, basemapUrls.osm.options),
            satelite: L.tileLayer(basemapUrls.satelite.url, basemapUrls.satelite.options),
            transport: L.tileLayer(basemapUrls.transport.url, basemapUrls.transport.options)
        };

        baseMaps['osm'].addTo(map);

        document.querySelectorAll('.basemap-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();

                const basemapType = this.dataset.basemap;

                // Remove all current layers
                Object.values(baseMaps).forEach(layer => {
                    map.removeLayer(layer);
                });

                // Add selected layer
                baseMaps[basemapType].addTo(map);

                if (document.body.classList.contains('dark') && basemapType == 'osm') {

                    document.querySelector('.leaflet-layer').classList.add('dark');
                }
            })
        });

        document.addEventListener('click', function(e) {
            // console.log(!(e.target.id === 'basemapGallery'));

            if (!(e.target.id == 'basemapGallery') && !(e.target.id == 'basemapGalleryHeader')) {
                document.querySelector('#basemapGallery').classList.add('hidden');
            }
        })
    </script>
    {{-- Basemap Setting --}}

    {{-- Darkmode Setting --}}
    <script>
        const darkBtn = document.getElementById('dark-btn');
        const baseElements = [
            '.leaflet-control-zoom-in',
            '.leaflet-control-zoom-out',
            '.leaflet-control-attribution',
            '.leaflet-control.leaflet-ruler',
            '.leaflet-popup-content-wrapper',
            '.leaflet-popup-tip',
            '.easy-button-container',
            '.leaflet-bar a',
            '.easy-button-button',
            '.leaflet-control-geocoder'
        ].join(',');

        darkBtn.addEventListener('click', function() {
            // Cek basemap yang aktif
            let currentBasemap = '';
            map.eachLayer((layer) => {
                if (layer instanceof L.TileLayer) {
                    // Cek URL layer untuk menentukan tipe basemap
                    if (layer._url.includes('google.com')) {
                        currentBasemap = 'satelite';
                    } else if (layer._url.includes('openstreetmap.org')) {
                        currentBasemap = 'osm';
                    }
                }
            });


            // Toggle dark mode untuk elements dasar
            document.querySelectorAll(baseElements).forEach(el => {
                el.classList.toggle('dark');
            });

            // Toggle dark mode untuk map layer hanya jika bukan satelit
            if (currentBasemap !== 'satelite') {
                document.querySelectorAll('.leaflet-layer').forEach(el => {
                    el.classList.toggle('dark');
                });
            }

            // Toggle body class
            document.body.classList.toggle('dark');

            const openPopup = document.querySelector('.leaflet-popup');
            // console.log(openPopup);
            if (openPopup) {
                openPopup.classList.toggle('dark');
            }

            // Toggle icon
            document.querySelector('.fa-moon').classList.toggle('hidden');
            document.querySelector('.fa-sun').classList.toggle('hidden');
        });

        // Tambahkan listener untuk perubahan basemap
        map.on('baselayerchange', function(e) {
            if (document.body.classList.contains('dark')) {
                const isSatelite = e.layer._url.includes('google.com');

                // Toggle dark mode untuk map layer
                document.querySelectorAll('.leaflet-layer').forEach(el => {
                    if (isSatelite) {
                        el.classList.remove('dark');
                    } else {
                        el.classList.add('dark');
                    }
                });
            }
        });
    </script>
    {{-- Darkmode Setting --}}

</body>


</html>
