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
    <link rel="stylesheet"
        href="https://unpkg.com/@geoapify/leaflet-address-search-plugin@^1/dist/L.Control.GeoapifyAddressSearch.min.css" />

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="https://cdn.jsdelivr.net/gh/gokertanrisever/leaflet-ruler@master/src/leaflet-ruler.js"
        integrity="sha384-8SqKZR7V8uOetpjjbcNJHvwuHpb074WS0UXjCLhzfJUqYn3B/uWx1WVv5mwRp1mV" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/leaflet-easybutton@2/src/easy-button.js"></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <script src="https://unpkg.com/@geoapify/leaflet-address-search-plugin@^1/dist/L.Control.GeoapifyAddressSearch.min.js">
    </script>

    <script src="https://kit.fontawesome.com/bd2b93a447.js" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="{{ asset('icon/favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/map-interaktif.css') }}">
    @vite('resources/css/app.css')
    <title>FinFinder | Peta Interaktif</title>
    <style>
        .leaflet-layer.dark,
        .leaflet-control-zoom-in.dark,
        .leaflet-control-zoom-out.dark,
        .leaflet-control-attribution.dark,
        .leaflet-control.leaflet-ruler.dark,
        .right-control-group.leaflet-control.dark,
        .easy-button-container.leaflet-control.dark,
        .search-location.dark {
            filter: invert(100%) hue-rotate(180deg) brightness(95%) contrast(90%) !important;
        }


        .leaflet-layer,
        .leaflet-control-zoom-in,
        .leaflet-control-zoom-out,
        .leaflet-control-attribution,
        .leaflet-control.leaflet-ruler,
        .easy-button-container.leaflet-control,
        .search-location {
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

        /* Atur container control */
        .leaflet-control-container .leaflet-top.leaflet-left {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            margin-left: 12px
        }

        .left-control-group,
        .right-control-group {
            display: flex;
            flex-direction: column;
        }

        .right2-control-group {
            display: flex;
            gap: 4px;
        }

        .right2-control-group .leaflet-bar {
            margin: 0px;
        }

        /* Hapus margin default */
        .leaflet-left .leaflet-control {
            margin-left: 0;
            clear: none !important;
        }

        .leaflet-bar.leaflet-ruler {
            width: 100%;
        }

        .button-state .fa {
            transform: scale(1.2);
        }

        .search-location {
            /* min-width: 100%; */
            min-width: 200px;
        }
    </style>
</head>

<body class="overflow-x-hidden font-inter">

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
                <button id="legenda-btn" class="text-2xl dark:text-slate-100 group">
                    <i class="transition-all duration-300 fa-solid fa-list group-hover:text-sky-500"></i>
                </button>
                <button id="layer-btn" class="text-2xl dark:text-slate-100 group">
                    <i class="transition-all duration-300 fa-solid fa-layer-group group-hover:text-sky-500"></i>
                </button>
            </div>
        </div>
    </header>

    <div id="map" class=" h-[calc(100vh-58px)] w-100">
        <div id="basemapGallery"
            class="hidden rounded-lg border-2 border-slate-300 absolute p-4 bg-white-100 top-24 left-[5.7rem] z-[999] dark:bg-slate-900 dark:border-slate-700 dark:text-white-100">
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
                <div class="text-center cursor-pointer ">
                    <a href="#" class="basemap-btn" data-basemap="ocean">
                        <img src="{{ asset('img/basemap/ocean.png') }}" alt=""
                            class="w-32 h-20 border-[3px] border-dashed rounded-lg border-slate-500 hover:opacity-80  transition-all duration-300">
                        <p class="mt-2 font-semibold text-black dark:text-white-100">ESRI Ocean </p>
                    </a>
                </div>
                <div class="text-center cursor-pointer ">
                    <a href="#" class="basemap-btn" data-basemap="voyager">
                        <img src="{{ asset('img/basemap/voyager.png') }}" alt=""
                            class="w-32 h-20 border-[3px] border-dashed rounded-lg border-slate-500 hover:opacity-80  transition-all duration-300">
                        <p class="mt-2 font-semibold text-black dark:text-white-100">CartoDB Voyager</p>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div id="legenda-modal"
        class="w-[300px] hidden transition-all duration-300 absolute top-16 right-2 border-2 border-slate-200 rounded-md z-[999999] h-[calc(100vh-70px)] bg-white-100 shadow-lg translate-x-[110%]">
        <div class="flex items-center justify-between px-4 py-2 font-bold rounded-t-md bg-sky-900 text-slate-100">
            <h4>Legenda</h4>
            <button class="transition-all duration-300 close-modal-legenda hover:text-slate-300">
                <i class="fa-solid fa-x"></i>
            </button>
        </div>
        <div class="flex flex-col gap-4 p-4 content-legenda">
            <div class="flex items-center gap-4 marker-ikan">
                <img src="{{ asset('img/marker-icon/ikan.png') }}" alt="marker ikan" class="w-6">
                <h4>Spot Ikan</h4>
            </div>
            <div class="flex items-center hidden gap-4 marker-user">
                <img src="{{ asset('img/marker-icon/user.png') }}" alt="marker user" class="w-6">
                <h4>Titik Lokasi</h4>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/func.js') }}"></script>
    <script src="{{ asset('js/icon.js') }}"></script>
    <script src="{{ asset('js/basemap.js') }}"></script>

    {{-- Leaflet JS --}}
    <script>
        var map = L.map('map').setView([1.169060, 102.432404], 10);
        map.on('popupopen', function(e) {
            if (document.body.classList.contains('dark')) {
                e.popup.getElement().classList.add('dark');
            } else {
                e.popup.getElement().classList.remove('dark');
            }
        });

        // default base map
        baseMaps['osm'].addTo(map);
    </script>
    {{-- Leaflet JS --}}


    {{-- Legenda --}}
    <script>
        const legendaBtn = document.querySelector('#legenda-btn');

        legendaBtn.addEventListener('click', function() {
            document.querySelector('#legenda-modal').classList.toggle('hidden');
            document.querySelector('#legenda-modal').classList.toggle('translate-x-[110%]');
        });

        document.querySelector('.close-modal-legenda').addEventListener('click', function() {
            document.querySelector('#legenda-modal').classList.add('translate-x-[110%]');
            document.querySelector('#legenda-modal').classList.add('hidden');
        })
    </script>
    {{-- Legenda --}}

    {{-- Button Control --}}
    <script>
        // Buat container untuk control sebelah kiri (zoom dan ruler)
        const leftControlContainer = L.DomUtil.create('div', 'left-control-group leaflet-control');

        // Buat container untuk control kanan .
        const rightControlContainer = L.DomUtil.create('div', 'right-control-group leaflet-control');

        const right1ControlContainer = L.DomUtil.create('div', 'right1-control-group');
        const right2ControlContainer = L.DomUtil.create('div', 'right2-control-group');

        // options ruler control
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

        // Base maps control
        let isEditable = false;
        let currentMarker = null;
        let mapClickHandler = null;
        let currentLine = null; // Tambahkan variabel untuk menyimpan referensi line

        // Ruler control
        const ruler = L.control.ruler(options).addTo(map);

        // Home control
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

        // Point control
        var pointControl = L.easyButton({
            states: [{
                stateName: 'point-control',
                icon: 'fa-location-dot',
                title: 'point-control',
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

                            if (currentMarker) {
                                document.querySelector('.marker-user').classList.remove('hidden');
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
                            document.querySelector('.marker-user').classList.add('hidden');
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

        var myAPIKey = '380779a6b2b24a899c67e7b3d7df04dc';
        const geocoder = L.control.addressSearch(myAPIKey, {
            position: 'topleft',
            className: 'search-location',
            placeholder: "Cari Lokasi ... ",
            resultCallback: (address) => {

                const markerUserElement = document.querySelector('.marker-user');

                if (currentMarker) {
                    currentMarker.remove();
                    markerUserElement?.classList.add('hidden');
                }

                if (currentLine) {
                    map.removeLayer(currentLine);
                }

                if (!address) {
                    return;
                }

                var searchLocation = {
                    lat: address.lat,
                    lng: address.lon
                }

                currentMarker = L.marker([address.lat, address.lon], {
                        icon: userIcon
                    }).addTo(map).bindPopup('Lokasi yang dicari')
                    .openPopup();

                // Hapus class hidden ketika ada marker baru
                markerUserElement?.classList.remove('hidden');

                if (address.bbox && address.bbox.lat1 !== address.bbox.lat2 && address.bbox.lon1 !== address
                    .bbox.lon2) {
                    map.fitBounds([
                        [address.bbox.lat1, address.bbox.lon1],
                        [address.bbox.lat2, address.bbox.lon2]
                    ], {
                        padding: [100, 100]
                    })
                } else {
                    map.setView([address.lat, address.lon], 12);
                }

                // Hitung jarak ke semua titik
                const nearestPoints = findNearestPoints(searchLocation);
                console.log(nearestPoints);

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
            },
            suggestionsCallback: (suggestions) => {
                console.log(suggestions);
            }
        });

        map.addControl(geocoder)
        homeBtn.button.classList.add('custom-control-button');
        layerControl.button.classList.add('custom-control-button');

        // Pindahkan zoom control ke left container
        const zoomControl = map.zoomControl.getContainer();
        leftControlContainer.appendChild(zoomControl);

        // Pindahkan ruler ke left container
        const rulerControl = ruler.getContainer();
        leftControlContainer.appendChild(rulerControl);

        // Pindahkan home dan layers ke right container
        rightControlContainer.appendChild(right1ControlContainer);
        rightControlContainer.appendChild(right2ControlContainer);

        right2ControlContainer.appendChild(homeBtn.getContainer());
        right2ControlContainer.appendChild(layerControl.getContainer());
        right2ControlContainer.appendChild(pointControl.getContainer());
        right1ControlContainer.appendChild(geocoder.getContainer());

        // Tambahkan kedua container ke map
        const topLeftControls = map.getContainer().querySelector('.leaflet-top.leaflet-left');
        topLeftControls.appendChild(leftControlContainer);
        topLeftControls.appendChild(rightControlContainer);

        // Tambahkan fungsi untuk mengecek status marker saat inisialisasi
        function checkInitialMarkerStatus() {
            const markerUserElement = document.querySelector('.marker-user');
            if (!currentMarker) {
                markerUserElement?.classList.add('hidden');
            } else {
                markerUserElement?.classList.remove('hidden');
            }
        }

        // Panggil fungsi saat halaman dimuat
        document.addEventListener('DOMContentLoaded', checkInitialMarkerStatus);
    </script>
    {{-- Button Control --}}

    {{-- Fish Spot --}}
    <script>
        // FishSpot
        var spots = @json($spots);
        console.log(spots);

        // Tampilkan FishSpot
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
    {{-- Fish Spot --}}

    {{-- Basemap Setting --}}
    <script>
        // Event untuk mengganti basemap
        document.querySelectorAll('.basemap-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();

                const basemapType = this.dataset.basemap;

                // Hapus Base Map yang di tampilkna
                Object.values(baseMaps).forEach(layer => {
                    map.removeLayer(layer);
                });

                // Menambahkan Base Map yang Dipilih
                baseMaps[basemapType].addTo(map);

                if (document.body.classList.contains('dark') && basemapType !== 'satelite') {

                    document.querySelector('.leaflet-layer').classList.add('dark');
                }
            })
        });

        document.addEventListener('click', function(e) {
            if (!(e.target.id == 'basemapGallery') && !(e.target.id == 'basemapGalleryHeader')) {
                document.querySelector('#basemapGallery').classList.add('hidden');
            }
        });
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
            '.search-location'
        ].join(',');

        darkBtn.addEventListener('click', function() {
            // Cek basemap yang aktif
            let currentBasemap = '';
            map.eachLayer((layer) => {
                if (layer instanceof L.TileLayer) {
                    // Cek URL layer untuk menentukan tipe basemap
                    if (layer._url.includes('google.com')) {
                        currentBasemap = 'satelite';
                    } else {
                        currentBasemap = 'other';
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

            // Check pop up leaflet ada atau tidak ada
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
