@extends('layouts.map')

@push('style')
    <style>
        ul li {
            list-style: disc;
            list-style-position: inside;
        }

        ol li {
            list-style: decimal;
            list-style-position: inside;
        }

        ol li p,
        ul li p {
            display: inline !important;
        }

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

        .right-control-group {
            gap: 4px;
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
            min-width: min(200px, 90vw);
            width: 100%;
            max-width: 300px;
        }

        .checkbox-xl {
            transform: scale(1.5)
        }

        .introjs-tooltip.introjs-floating {
            width: 500px
        }
    </style>
@endpush

@section('content')
    <header id="navbar" class="w-full px-12 py-2 transition-all duration-300 shadow-lg bg-slate-100 dark:bg-slate-900">
        <div class="flex items-center justify-between">
            <img src="{{ asset('img/finfinder.png') }}" alt="logo" class="w-32">
            <ul id="navbar-menu" class="hidden gap-8 lg:flex">
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
                @if (Auth::check())
                    <li class="list-none">
                        <a href="{{ route('dashboard') }}"
                            class="!flex flex-col items-center justify-center transition-all duration-300 hover:text-sky-500 group dark:text-slate-100">
                            Dashboard
                            <hr class="w-0 duration-500 group-hover:border-sky-500 group-hover:w-full group-hover:border">
                        </a>
                    </li>
                @endif
            </ul>
            <div id="map-menu" class="flex gap-4">
                <button id="dark-btn" class="dark:text-slate-100">
                    <i class="text-2xl transition-all duration-300 fa-solid fa-moon hover:text-sky-500"></i>
                    <i class="hidden text-2xl transition-all duration-300 fa-solid fa-sun hover:text-sky-500"></i>
                </button>
                <button id="legenda-btn" class="text-2xl dark:text-slate-100 group">
                    <i class="transition-all duration-300 fa-solid fa-list group-hover:text-sky-500"></i>
                </button>
                <button id="layers-btn" class="text-2xl dark:text-slate-100 group">
                    <i class="transition-all duration-300 fa-solid fa-layer-group group-hover:text-sky-500"></i>
                </button>
            </div>
        </div>
    </header>

    <div id="map" class=" h-[calc(100vh-115px)] lg:h-[calc(100vh-58px)] w-100">
        <div id="basemapGallery"
            class="transition-all duration-300 hidden opacity-0 rounded-lg border-2 border-slate-300 absolute p-4 bg-white-100 top-24 left-[5.7rem] z-[999] dark:bg-slate-900 dark:border-slate-700 dark:text-white-100">
            <div id="basemapGalleryHeader" class="flex justify-between">
                <h4 class="text-base font-bold">BaseMap Gallery</h4>
                <button id="close-btn-basemap"><i class="fa-solid fa-x"></i></button>
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

    <div id="nav-bottom"
        class="fixed nav-bottom -bottom-[2.80rem] z-[999999] transition-all duration-300  bg-white-100 w-screen px-4 py-2 border-t-2 border-slate-900 lg:hidden dark:bg-slate-900 dark:text-slate-100 dark:border-slate-100">
        <div id="nav-scroll"
            class="absolute flex items-center justify-center h-4 -translate-x-1/2 border-t-2 border-l-2 border-r-2 rounded-t-lg cursor-pointer w-14 border-slate-900 bg-white-100 left-1/2 -top-[0.95rem] dark:bg-slate-900 dark:border-slate-100 transition-all duration-300">
            <i class="fa-solid fa-angle-up dark:text-slate-100"></i>
        </div>
        <div id="nav-bottom-menu" class="flex justify-center gap-10 pr-2 text-2xl nav-bottom-menu">
            <a href="/"><i class="fa-solid fa-house"></i></a>
            <a href="/profil"><i class="fa-solid fa-magnifying-glass"></i></a>
            <a href="/peta-interaktif"><i class="fa-solid fa-map text-sky-500"></i></a>
            <a href="/contact-us"><i class="fa-solid fa-envelope"></i></a>
            @if (Auth::check())
                <a href="/dashboard"><i class="fa-solid fa-chart-simple"></i></a>
            @endif
        </div>
    </div>

    {{-- legenda modal --}}
    <div id="legenda-modal"
        class="fixed hidden w-full md:w-[300px] transition-all duration-300 md:top-16 md:right-2 border-[3px] border-slate-200 rounded-md z-[999999] h-[370px] md:h-[calc(100vh-70px)] bg-white-100 shadow-lg dark:bg-slate-900 dark:border-slate-700 bottom-0  flex flex-col opacity-0">
        <div
            class="flex items-center justify-between px-4 py-2 font-bold rounded-t bg-sky-900 text-slate-100 dark:bg-sky-950">
            <h4>Legenda</h4>
            <button class="transition-all duration-300 close-modal-legenda hover:text-slate-300">
                <i class="fa-solid fa-x"></i>
            </button>
        </div>
        <div
            class="flex flex-col h-full gap-4 px-6 py-4 overflow-y-auto transition-all duration-300 content-legenda dark:text-slate-100">
            <div class="flex items-center gap-4 marker-ikan">
                <img src="{{ asset('img/marker-icon/ikan.png') }}" alt="marker ikan" class="w-6">
                <h4>Spot Ikan</h4>
            </div>
            <div class="flex items-center hidden gap-4 marker-user">
                <img src="{{ asset('img/marker-icon/user.png') }}" alt="marker user" class="w-6">
                <h4>Titik Lokasi</h4>
            </div>
            <div class="flex items-center hidden gap-4 line">
                <hr class="w-10 border-4 border-[#5c88eb] border-dashed rounded-full">
                <h4>Jarak Lokasi</h4>
            </div>
        </div>
    </div>

    {{-- layers modal --}}
    <div id="layers-modal"
        class="fixed hidden w-full md:w-[300px] transition-all duration-300 md:top-16 md:right-2 border-[3px] border-slate-200 rounded-md z-[999999] h-[370px] md:h-[calc(100vh-70px)] bg-white-100 shadow-lg dark:bg-slate-900 dark:border-slate-700 bottom-0 flex flex-col opacity-0">
        <div
            class="flex items-center justify-between px-4 py-2 font-bold rounded-t bg-sky-900 text-slate-100 dark:bg-sky-950">
            <h4>Layers</h4>
            <button class="transition-all duration-300 close-modal-layers hover:text-slate-300">
                <i class="fa-solid fa-x"></i>
            </button>
        </div>
        <div
            class="flex flex-col h-full gap-4 px-4 py-4 overflow-y-auto transition-all duration-300 content-layers dark:text-slate-100">

            <!-- Accordion Item 1 -->
            <div class="">
                <button onclick="handleAccordionClick(event, 1)"
                    class="flex items-center w-full gap-4 p-2 transition-all duration-300 rounded hover:bg-slate-200 dark:hover:bg-slate-800">
                    <i id="icon-1" class="transition-all duration-300 fa-solid fa-caret-right"></i>
                    <div class="flex items-center gap-2" onclick="event.stopPropagation()">
                        <input type="checkbox" name="allFish" id="allFish" checked class="checkbox-xl"
                            onchange="toggleAllFish(this)">
                        <label for="allFish">Semua Ikan</label>
                    </div>
                </button>
                <div id="content-1" class="overflow-hidden transition-all duration-300 ease-in-out max-h-0">
                    <div class="flex flex-col pl-2">
                        @foreach ($fishtypes as $ikan)
                            <div
                                class="flex items-center justify-between gap-2 p-2 pl-8 rounded hover:bg-slate-100 dark:hover:bg-slate-700">
                                <div class="">
                                    <input type="checkbox" name="ikan-{{ $ikan->nama }}"
                                        id="ikan-{{ $ikan->nama }}" checked class="checkbox-xl fish-type-checkbox"
                                        onchange="updateAllFishCheckbox()">
                                    <label for="ikan-{{ $ikan->nama }}">{{ $ikan->nama }}</label>
                                </div>
                                <button onclick="selectOnlyThis('{{ $ikan->nama }}')"
                                    class="px-2 py-1 text-gray-500 transition-all duration-300 rounded hover:text-gray-900 hover:bg-slate-300 dark:text-slate-300 dark:hover:bg-slate-500">HANYA</button>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('js/func.js') }}"></script>
    <script src="{{ asset('js/icon.js') }}"></script>
    <script src="{{ asset('js/basemap.js') }}"></script>

    {{-- Component --}}
    <script>
        const legendaBtn = document.querySelector('#legenda-btn');
        const legendaModal = document.querySelector('#legenda-modal');
        const layersBtn = document.querySelector('#layers-btn');
        const layersModal = document.querySelector('#layers-modal');

        const navBottom = document.querySelector('#nav-bottom');
        const navScroll = document.querySelector('#nav-scroll');

        const isMobile = window.innerWidth < 1024;
    </script>
    {{-- Component --}}

    <script>
        navScroll.addEventListener('click', function() {
            navBottom.classList.toggle('-bottom-[2.80rem]')
            navBottom.classList.toggle('bottom-0')
        });
    </script>

    {{-- Legenda --}}
    <script>
        legendaBtn.addEventListener('click', function() {
            if (legendaModal.classList.contains('opacity-0')) {
                // Close layers modal
                layersModal.classList.add('opacity-0');
                setTimeout(() => {
                    layersModal.classList.add('hidden');
                }, 300);

                // Open legenda modal
                legendaModal.classList.remove('hidden');
                setTimeout(() => {
                    legendaModal.classList.remove('opacity-0');
                }, 10);
            } else {
                // Close legenda modal
                legendaModal.classList.add('opacity-0');
                setTimeout(() => {
                    legendaModal.classList.add('hidden');
                }, 300);
            }
        });

        document.querySelector('.close-modal-legenda').addEventListener('click', function() {
            legendaModal.classList.add('opacity-0');
            setTimeout(() => {
                legendaModal.classList.add('hidden');
            }, 300);
        });
    </script>
    {{-- Legenda --}}

    {{-- Layers --}}
    <script>
        layersBtn.addEventListener('click', function() {
            if (layersModal.classList.contains('opacity-0')) {
                // Close legenda modal
                legendaModal.classList.add('opacity-0');
                setTimeout(() => {
                    legendaModal.classList.add('hidden');
                }, 300);

                // Open layers modal
                layersModal.classList.remove('hidden');
                setTimeout(() => {
                    layersModal.classList.remove('opacity-0');
                }, 10);
            } else {
                // Close layers modal
                layersModal.classList.add('opacity-0');
                setTimeout(() => {
                    layersModal.classList.add('hidden');
                }, 300);
            }
        });

        document.querySelector('.close-modal-layers').addEventListener('click', function() {
            layersModal.classList.add('opacity-0');
            setTimeout(() => {
                layersModal.classList.add('hidden');
            }, 300);
        });
    </script>
    {{-- Layers --}}

    {{-- Leaflet JS --}}
    <script>
        var map = L.map('map').setView([1.0325711837093985, 102.62127433486428], isMobile ? 8 : 9);
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
                title: 'Home', // like its title
                onClick: function(btn, map) { // and its callback
                    map.setView([1.0325711837093985, 102.62127433486428], isMobile? 8 : 9);
                    btn.state('home'); // change state on click!
                }
            }]
        }).addTo(map);

        // Base maps control
        var layerControl = L.easyButton({
            states: [{
                stateName: 'basemap', // name the state
                icon: 'fa-map', // and define its properties
                title: 'Basemap', // like its title
                onClick: function() { // and its callback
                    const basemapGallery = document.querySelector('#basemapGallery');
                    basemapGallery.classList.toggle('hidden');
                    // Add small delay to ensure smooth transition
                    setTimeout(() => {
                        basemapGallery.classList.toggle('opacity-0');
                    }, 10);
                }
            }]
        }).addTo(map);

        // Point control
        var pointControl = L.easyButton({
            states: [{
                stateName: 'point-control',
                icon: 'fa-location-dot',
                title: 'Titik Lokasi',
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
                            if (currentLine) {
                                document.querySelector('.line').classList.remove('hidden');
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
                            document.querySelector('.line').classList.add('hidden');
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

        var guideControl = L.easyButton({
            states: [{
                stateName: 'point-control',
                icon: 'fa-info-circle',
                title: 'Pentunjuk',
                onClick: function() {
                    guide()
                    // const targetMarker = fishMarkers[2].marker;

                    // console.log(fishMarkers[2].marker);
                    // console.log(targetMarker.getLatLng());
                    // map.flyTo(targetMarker.getLatLng(), 15)
                },
            }]
        }).addTo(map);

        var myAPIKey = '380779a6b2b24a899c67e7b3d7df04dc';
        const geocoder = L.control.addressSearch(myAPIKey, {
            position: 'topleft',
            className: 'search-location',
            placeholder: "Cari Lokasi ... ",
            resultCallback: (address) => {

                const markerUserElement = document.querySelector('.marker-user');
                const lineElement = document.querySelector('.line');

                if (currentMarker) {
                    currentMarker.remove();
                    markerUserElement?.classList.add('hidden');
                }

                if (currentLine) {
                    map.removeLayer(currentLine);
                    lineElement?.classList.add('hidden');
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

                    if (currentLine) {
                        lineElement?.classList.remove('hidden');
                    }

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
        right2ControlContainer.appendChild(guideControl.getContainer());
        right1ControlContainer.appendChild(geocoder.getContainer());

        // Tambahkan kedua container ke map
        const topLeftControls = map.getContainer().querySelector('.leaflet-top.leaflet-left');
        topLeftControls.appendChild(leftControlContainer);
        topLeftControls.appendChild(rightControlContainer);

        // Tambahkan fungsi untuk mengecek status marker saat inisialisasi
        function checkInitialMarkerStatus() {
            const markerUserElement = document.querySelector('.marker-user');
            const lineElement = document.querySelector('.line');
            if (!currentMarker) {
                markerUserElement?.classList.add('hidden');
                lineElement?.classList.add('hidden');
                // alert('hello')
            } else {
                markerUserElement?.classList.remove('hidden');
                lineElement?.classList.remove('hidden');
                alert('hilang')
            }
        }

        // Panggil fungsi saat halaman dimuat
        document.addEventListener('DOMContentLoaded', checkInitialMarkerStatus);
    </script>
    {{-- Button Control --}}

    {{-- Checked Checkbox --}}
    <script>
        // Fungsi untuk menangani klik pada accordion
        function handleAccordionClick(event, index) {
            // Jika yang diklik adalah checkbox atau labelnya, jangan trigger accordion
            if (event.target.type === 'checkbox' || event.target.tagName === 'LABEL') {
                return;
            }

            toggleAccordion(index);
        }

        function toggleAccordion(index) {
            const content = document.getElementById(`content-${index}`);
            const icon = document.getElementById(`icon-${index}`);
            console.log(icon);


            if (content.style.maxHeight && content.style.maxHeight !== '0px') {
                content.style.maxHeight = '0';
                icon.style.transform = 'rotate(0deg)';
            } else {
                content.style.maxHeight = content.scrollHeight + 'px';
                icon.style.transform = 'rotate(90deg)';
            }
        }

        // Fungsi untuk toggle semua checkbox ikan
        function toggleAllFish(checkbox) {
            const fishCheckboxes = document.querySelectorAll('.fish-type-checkbox');
            fishCheckboxes.forEach(fishCheckbox => {
                fishCheckbox.checked = checkbox.checked;
            });
            updateMarkerVisibility();

            updateDistanceCalculation();
        }

        // Update fungsi toggle semua checkbox ikan
        function updateAllFishCheckbox() {
            const allFishCheckbox = document.getElementById('allFish');
            const fishCheckboxes = document.querySelectorAll('.fish-type-checkbox');
            const allChecked = Array.from(fishCheckboxes).every(checkbox => checkbox.checked);
            allFishCheckbox.checked = allChecked;
            updateMarkerVisibility();
            updateDistanceCalculation();
        }

        // Fungsi untuk memilih hanya satu jenis ikan
        function selectOnlyThis(fishName) {
            const fishCheckboxes = document.querySelectorAll('.fish-type-checkbox');
            fishCheckboxes.forEach(checkbox => {
                checkbox.checked = checkbox.id === `ikan-${fishName}`;
            });
            updateAllFishCheckbox();
            updateMarkerVisibility();
            updateDistanceCalculation();
        }

        // Fungsi untuk update perhitungan jarak
        function updateDistanceCalculation() {
            // Hapus line yang ada jika ada
            const lineElement = document.querySelector('.line');

            if (currentLine) {
                map.removeLayer(currentLine);
                currentLine = null;
            }

            // Cek apakah ada marker dan minimal satu checkbox tercentang
            const anyChecked = document.querySelectorAll('.fish-type-checkbox:checked').length > 0;
            if (currentMarker && anyChecked) {
                const searchLocation = {
                    lat: currentMarker.getLatLng().lat,
                    lng: currentMarker.getLatLng().lng
                };

                // Hitung jarak ke titik terdekat
                const nearestPoints = findNearestPoints(searchLocation);

                if (nearestPoints && nearestPoints.length > 0) {
                    const nearestPoint = nearestPoints[0];
                    currentLine = L.polyline([
                        searchLocation,
                        [nearestPoint.spot.latitude, nearestPoint.spot.longitude]
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

                    // Update bounds untuk menampilkan seluruh line
                    const bounds = L.latLngBounds([
                        searchLocation,
                        [nearestPoint.spot.latitude, nearestPoint.spot.longitude]
                    ]);
                    map.fitBounds(bounds, {
                        padding: [100, 100]
                    });

                }
                if (currentLine) {
                    lineElement?.classList.remove('hidden');
                }
            }
            if (!currentLine) {
                lineElement?.classList.add('hidden');
            }
        }
    </script>
    {{-- Checked Checkbox --}}

    {{-- Fish Spot --}}
    <script>
        // Simpan referensi marker dalam array global
        let fishMarkers = [];

        // Fungsi untuk membuat marker
        function createFishMarker(spot, index) {
            let fishArray = spot.fishes;
            // let index = 0

            const fishesHTML = Array.isArray(fishArray) ?
                fishArray.map(fish => {
                    return `
                <span class="p-1 transition-all duration-300 border rounded w-fit border-sky-300 hover:bg-sky-300">
                    ${fish}
                </span>
            `;
                }).join('') :
                '';

            const marker = L.marker([spot.latitude, spot.longitude], {
                icon: fishIcon,
                id: 'fishMarker-' + index++,
            }).bindPopup(`
                <div class="mb-4">
                    <h4 class="font-bold text-md">Detail Data</h4>
                </div>
                <div class="flex flex-wrap gap-1 mb-4">
                    ${fishesHTML}
                </div>
                <div class="mb-4">
                    ${spot.deskripsi}
                </div>
                <div class="flex justify-between border-t border-slate-200">
                    <p class="text-gray-400">Dibuat Oleh <span class="not-italic font-bold">${spot.owner}</span></p>
                    <p class="text-gray-400">${spot.created_at}</p>
                </div>
            `);

            // Tambahkan class setelah marker ditambahkan ke map
            marker.on('add', function() {
                const markerElement = marker.getElement();
                markerElement.classList.add('fish-marker');
                markerElement.classList.add(`fish-marker-${index}`);
            });

            return {
                marker: marker,
                fishes: fishArray
            };
        }
        // FishSpot
        var spots = @json($spots);
        console.log(spots);

        spots.forEach((spot, index) => {
            const markerData = createFishMarker(spot, index);
            fishMarkers.push(markerData);
            markerData.marker.addTo(map);
        });

        // Fungsi untuk memperbarui tampilan marker berdasarkan checkbox
        function updateMarkerVisibility() {
            const checkedFishes = Array.from(document.querySelectorAll('.fish-type-checkbox:checked'))
                .map(checkbox => checkbox.id.replace('ikan-', ''));

            fishMarkers.forEach(markerData => {
                const shouldShow = markerData.fishes.some(fish => checkedFishes.includes(fish));
                if (shouldShow) {
                    if (!map.hasLayer(markerData.marker)) {
                        markerData.marker.addTo(map);
                    }
                } else {
                    if (map.hasLayer(markerData.marker)) {
                        markerData.marker.remove();
                    }
                }
            });
        }
    </script>
    {{-- Fish Spot --}}

    {{-- Intro JS --}}
    <script>
        function guide() {
            const tourConfig = @json($tourSteps);
            // Fungsi untuk menutup semua modal dan mereset tampilan
            function resetModalAndMapState() {
                // Menutup semua modal
                const modals = ['legenda-modal', 'layers-modal', 'basemapGallery'];
                modals.forEach(modalId => {
                    const modal = document.getElementById(modalId);
                    if (modal) {
                        modal.classList.add('opacity-0');
                    }
                });

                // Reset posisi navigation bottom jika dalam mode mobile
                const navBottom = document.getElementById('nav-bottom');
                if (navBottom) {
                    navBottom.classList.add('-bottom-[2.80rem]');
                    navBottom.classList.remove('bottom-0');
                }

                // Reset tampilan peta ke posisi awal
                map.setView([1.0325711837093985, 102.62127433486428], isMobile ? 8 : 9);

                // Menutup popup yang mungkin terbuka
                const marker = fishMarkers[5].marker;
                if (marker && marker.isPopupOpen()) {
                    marker.closePopup();
                }
            }

            // Panggil fungsi reset sebelum memulai tour
            resetModalAndMapState();
            const steps = isMobile ? tourConfig.tourSteps.mobile : tourConfig.tourSteps.desktop;

            const intro = introJs().setOptions({
                disableInteraction: true,
                nextLabel: 'Selanjutnya',
                prevLabel: 'Sebelumnya',
                doneLabel: 'Selesai',
                steps: steps
            });

            // Tambahkan variabel untuk track step saat ini
            let currentStep = 0;

            function handleNavBottomPosition(targetElement, currentstep) {
                console.log(currentstep);

                const navBottom = document.getElementById('nav-bottom');

                // Langkah yang membutuhkan nav-bottom ditampilkan
                const navBottomVisibleSteps = [1, 2]; // Sesuaikan dengan step yang membutuhkan nav-bottom
                const helperLayer = document.querySelector('.introjs-helperLayer');
                const tooltip = document.querySelector('.introjs-tooltip');

                if (targetElement?.classList.contains('nav-bottom') || targetElement?.classList.contains(
                        'nav-bottom-menu')) {
                    navBottom.classList.remove('-bottom-[2.80rem]');
                    navBottom.classList.add('bottom-0');

                    // Berikan waktu untuk animasi transisi selesai
                    setTimeout(() => {
                        if (helperLayer && (currentstep === 1 || currentstep === 2)) {
                            const navBottomRect = navBottom.getBoundingClientRect();
                            Object.assign(helperLayer.style, {
                                top: `${navBottomRect.top - 5}px`,
                                left: `${navBottomRect.left - 5}px`,
                                width: `${navBottomRect.width + 10}px`,
                                height: `${navBottomRect.height + 10}px`
                            });
                        }
                        // Atur posisi tooltip khusus untuk nav-bottom
                        if (tooltip && currentstep === 1) {
                            tooltip.style.transform = 'translate(0, -50px)';
                        }
                    }, 300);

                } else if (!targetElement?.classList.contains('nav-bottom') && !targetElement?.classList.contains(
                        'nav-bottom-menu')) { // Sesuaikan dengan step setelah nav-bottom
                    navBottom.classList.add('-bottom-[2.80rem]');
                    navBottom.classList.remove('bottom-0');
                }

                // Khusus untuk menangani perpindahan balik ke menu
                if (targetElement?.classList.contains('nav-bottom-menu')) {
                    setTimeout(() => {
                        if (helperLayer) {
                            const menuRect = targetElement.getBoundingClientRect();
                            Object.assign(helperLayer.style, {
                                top: `${menuRect.top - 5}px`,
                                left: `${menuRect.left - 5}px`,
                                width: `${menuRect.width + 10}px`,
                                height: `${menuRect.height + 10}px`
                            });
                        }
                        // Atur posisi tooltip khusus untuk nav-bottom
                        if (tooltip && currentstep === 2) {
                            tooltip.style.transform = 'translate(0, -50px)';
                        }
                    }, 300);
                }
            }

            // Event handler sebelum step berubah
            intro.onbeforechange(function(targetElement) {
                const modals = {
                    'legenda-modal': {
                        step: 5
                    },
                    'layers-modal': {
                        step: 7
                    },
                    'basemapGallery': {
                        step: 16
                    }
                };

                function handleModal(modalId, isTarget) {
                    const modal = document.getElementById(modalId);
                    if (!modal) return;

                    if (isTarget) {
                        modal.classList.remove('hidden');
                        setTimeout(() => {
                            modal.classList.remove('opacity-0');
                        }, 10);
                    } else if (!isTarget) {
                        console.log('yes');

                        modal.classList.add('opacity-0');
                        setTimeout(() => {
                            modal.classList.add('hidden');
                        }, 300);
                    }
                }

                Object.keys(modals).forEach(modalId => {
                    handleModal(modalId, targetElement?.id === modalId);
                });


                // Menangani marker dan popup
                const nextStep = intro._currentStep;
                const tooltip = document.querySelector('.introjs-tooltip');


                console.log(nextStep);

                handleNavBottomPosition(targetElement, nextStep);

                const marker = fishMarkers[5].marker;

                if (targetElement?.classList.contains('fish-marker-7')) {
                    marker.closePopup();
                }

                // Menangani popup pada step 10
                if (nextStep === 10) {
                    marker.closePopup();
                    setTimeout(() => {
                        marker.openPopup();
                        setTimeout(() => {
                            const popup = document.querySelector('.leaflet-popup');
                            if (popup) {
                                popup.classList.add('intro-highlight-popup');

                                // Update element dan helper layer
                                const currentStep = intro._options.steps[nextStep];
                                currentStep.element = '.intro-highlight-popup';

                                const helperLayer = document.querySelector('.introjs-helperLayer');
                                if (helperLayer) {
                                    const popupRect = popup.getBoundingClientRect();
                                    Object.assign(helperLayer.style, {
                                        top: `${popupRect.top - 5}px`,
                                        left: `${popupRect.left - (isMobile ? 30 : 5)}px`,
                                        width: `${popupRect.width + 10}px`,
                                        height: `${popupRect.height + 10}px`
                                    });
                                }

                                // Mengatur posisi tooltip
                                const tooltip = document.querySelector('.introjs-tooltip');
                                if (tooltip) {
                                    tooltip.style.transform = isMobile ? 'translate(0, 200px) ' :
                                        'translate(-250px, 0)'
                                    tooltip.style.marginLeft = '-250px';
                                }
                            }
                        }, 100);
                    }, 50);
                } else {
                    // Reset posisi tooltip untuk step lainnya
                    if (tooltip) {
                        tooltip.style.transform = 'translate(0, 0)'
                        tooltip.style.marginLeft = '0px';
                    }
                }

            });

            intro.onafterchange(function(targetElement) {
                // Update step saat ini
                currentStep = intro._currentStep;

                const marker = fishMarkers[5].marker;
                if (marker.isPopupOpen()) {
                    marker.closePopup();
                }
            });

            intro.oncomplete(function() {
                // Daftar ID modal yang perlu ditutup
                const modalIds = ['legenda-modal', 'layers-modal', 'basemapGallery'];

                modalIds.forEach(id => {
                    const modal = document.getElementById(id);
                    if (modal) {
                        modal.classList.add('opacity-0');
                        setTimeout(() => {
                            modal.classList.add('hidden');
                        }, 300);
                    }
                });

                const navBottom = document.getElementById('nav-bottom');
                navBottom.classList.remove('bottom-0');
                navBottom.classList.add('-bottom-[2.80rem]');

                // Menutup popup marker jika terbuka
                const marker = fishMarkers[5].marker;
                if (marker.isPopupOpen()) {
                    marker.closePopup();
                }
            });

            intro.onexit(function() {
                // Daftar ID modal yang perlu ditutup
                const modalIds = ['legenda-modal', 'layers-modal', 'basemapGallery'];

                modalIds.forEach(id => {
                    const modal = document.getElementById(id);
                    if (modal) {
                        modal.classList.add('opacity-0');
                        setTimeout(() => {
                            modal.classList.add('hidden');
                        }, 300);
                    }
                });
                const navBottom = document.getElementById('nav-bottom');
                navBottom.classList.add('-bottom-[2.80rem]');
                navBottom.classList.remove('bottom-0');

                const marker = fishMarkers[5].marker;
                if (marker.isPopupOpen()) {
                    marker.closePopup();
                }
            });

            intro.refresh = function() {
                if (this._currentStep !== undefined) {
                    this._highlightElement(this._introItems[this._currentStep]);
                }
            };

            intro.start();
        }
    </script>
    {{-- Intro JS --}}

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
            const basemapGallery = document.querySelector('#basemapGallery');
            const isInTour = document.querySelector('.introjs-overlay');

            // Hanya jalankan jika tidak sedang dalam tour
            if (!isInTour &&
                !(e.target.id === 'basemapGallery') &&
                !(e.target.id === 'basemapGalleryHeader') &&
                !e.target.closest('#basemapGallery')) {

                basemapGallery.classList.add('opacity-0');
                setTimeout(() => {
                    basemapGallery.classList.add('hidden');
                }, 300);
            }
        });

        const closeButton = document.querySelector('#close-btn-basemap');
        const basemapGallery = document.querySelector('#basemapGallery');

        closeButton.addEventListener('click', function() {
            basemapGallery.classList.add('opacity-0');
            setTimeout(() => {
                basemapGallery.classList.add('hidden');
            }, 300);
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
@endpush
