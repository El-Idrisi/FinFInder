<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
    <script src="https://kit.fontawesome.com/bd2b93a447.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
    <link rel="shortcut icon" href="{{ asset('icon/favicon.ico') }}" type="image/x-icon">

    {{-- jquery --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    @stack('style')
    @vite('resources/css/app.css')
    <title>{{ $title }}</title>
</head>

<body class="relative font-inter -z-[9999] overflow-x-hidden bg-sky-50">

    <x-sidebar-dashboard></x-sidebar-dashboard>

    <div class="lg:ml-[240px]" id="content">
        <x-navbar-dashboard></x-navbar-dashboard>

        <div class="px-4 pb-8 lg:px-8 pt-28">
            @yield('content')
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

    <script src="{{ asset('js/map.js') }}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <script>
        const accordions = document.querySelectorAll('.accordion');

        accordions.forEach(acc => {
            acc.addEventListener('click', function() {
                var panel = this.nextElementSibling;
                if (!panel.classList.contains('accor')) {
                    if (panel.style.maxHeight) {
                        panel.style.maxHeight = null;
                        this.classList.toggle('active')
                    } else {
                        panel.style.maxHeight = panel.scrollHeight + 'px';
                        this.classList.toggle('active')
                    }
                } else {
                    panel.classList.toggle('active')
                    if (panel.classList.contains("active")) {
                        panel.style.maxHeight = panel.scrollHeight + "px";
                    } else {
                        panel.style.maxHeight = "0px";
                    }
                }
            });
        });

        const sidebar = document.querySelector('#sidebar');
        const content = document.querySelector('#content');
        const hambuger = document.querySelector("#hambuger")
        const bgCover = document.querySelector("#bg-cover")
        const navbar = document.querySelector("#navbar");

        if (window.innerWidth <= 768) {
            hambuger.addEventListener('click', (event) => {
                event.stopPropagation();
                sidebar.classList.remove("-translate-x-full");
                sidebar.classList.add("translate-x-0");
                bgCover.classList.remove("scale-0");
                bgCover.classList.remove("bg-opacity-0");
                bgCover.classList.add("bg-opacity-30");
            });

            document.addEventListener('click', (event) => {
                if (!sidebar.contains(event.target) && !hambuger.contains(event.target)) {
                    sidebar.classList.remove("translate-x-0");
                    sidebar.classList.add("-translate-x-full");
                    bgCover.classList.add("scale-0");
                    bgCover.classList.remove("bg-opacity-30");
                    bgCover.classList.add("bg-opacity-0");
                }
            });

        } else {
            hambuger.addEventListener('click', () => {
                sidebar.classList.toggle("lg:translate-x-0")
                content.classList.toggle("lg:ml-[240px]")
                navbar.classList.toggle("lg:w-[calc(100vw-240px)]")
            });
        }

        @if (Session::has('success'))
            Swal.fire({
                title: 'Success!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonText: 'Nice'
            })
        @endif
    </script>

    <script>
        function initMap(options = {}) {
            const {
                containerId = 'map',
                    latitude = 1.3848069459548475,
                    longitude = 102.18214794585786,
                    zoom = 10,
                    isEditable = false,
                    spotData = null,
                    isEdit = false // Tambah parameter untuk mode edit
            } = options;
            if (window.innerWidth > 768) {

            }
            let map = L.map(containerId, {
                fullscreenControl: true,
                gestureHandling: window.innerWidth > 768 ? true : false,
            }).setView([latitude, longitude], zoom);

            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);

            let currentMarker = null;

            // Jika mode edit atau edit existing spot
            if (isEditable || isEdit) {
                map.on('click', function(e) {
                    const lat = e.latlng.lat;
                    const lng = e.latlng.lng;

                    if (currentMarker) {
                        map.removeLayer(currentMarker);
                    }

                    currentMarker = L.marker([lat, lng]).addTo(map);
                    currentMarker.bindPopup("Latitude: " + lat + "<br>Longitude: " + lng).openPopup();

                    document.getElementById('latitude').value = lat;
                    document.getElementById('longitude').value = lng;
                });

                // Jika mode edit, gunakan data yang ada
                if (isEdit && spotData) {
                    currentMarker = L.marker([spotData.latitude, spotData.longitude]).addTo(map);
                    currentMarker.bindPopup("Latitude: " + spotData.latitude + "<br>Longitude: " + spotData.longitude)
                        .openPopup();
                    map.setView([spotData.latitude, spotData.longitude], zoom);
                } else {
                    // Jika ada nilai yang tersimpan
                    const savedLat = document.getElementById('latitude')?.value;
                    const savedLng = document.getElementById('longitude')?.value;
                    if (savedLat && savedLng) {
                        currentMarker = L.marker([savedLat, savedLng]).addTo(map);
                        currentMarker.bindPopup("Latitude: " + savedLat + "<br>Longitude: " + savedLng).openPopup();
                    }
                }
            }

            // Jika mode view (dengan data spot)
            if (spotData && !isEdit) {
                const marker = L.marker([spotData.latitude, spotData.longitude]).addTo(map);
                marker.bindPopup(spotData.popupContent);

                // Tambahkan coordinate display
                const coordDisplay = L.control({
                    position: 'topright'
                });
                coordDisplay.onAdd = function(map) {
                    const div = L.DomUtil.create('div', 'coord-display');
                    div.style.background = 'white';
                    div.style.padding = '5px';
                    div.style.border = '2px solid #ccc';
                    return div;
                };
                coordDisplay.addTo(map);

                const coord = document.querySelector('.coord-display');
                coord.innerHTML = `
                    <strong>Koordinat Titik Lokasi:</strong><br>
                    Lat:${spotData.latitude}, Long:${spotData.longitude}
                `;
            }

            setTimeout(() => {
                map.invalidateSize();
            }, 100);

            return map;
        }

        function initMapTabs(spotData = null) { // Tambah parameter spotData
            const tabs = document.querySelectorAll('.tabs');
            tabs.forEach((tab) => {
                tab.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Update tab active state
                    tabs.forEach(t => t.classList.remove('tab-active'));
                    tab.classList.add('tab-active');

                    // Update line position
                    const line = document.querySelector('.line');
                    line.style.width = e.target.offsetWidth + 'px';
                    line.style.left = e.target.offsetLeft + 'px';

                    // Get coordinates (dari spotData jika ada, atau dari input)
                    const savedLat = spotData ? spotData.latitude : (document.getElementById('latitude')
                        ?.value || '');
                    const savedLng = spotData ? spotData.longitude : (document.getElementById('longitude')
                        ?.value || '');

                    const panel = document.querySelector('#panel');

                    if (e.target.classList.contains('map')) {
                        panel.innerHTML = `
                    <div class="w-full mt-2 border-2 rounded-md h-80 border-slate-400" id="map"></div>
                    <small class="text-slate-500">Pilih pada peta untuk menentukan titik lokasi</small>
                    <input type="hidden" id="latitude" name="latitude" value="${savedLat}">
                    <input type="hidden" id="longitude" name="longitude" value="${savedLng}">
                `;

                        initMap({
                            isEditable: true,
                            isEdit: !!spotData,
                            spotData: spotData,
                            latitude: savedLat || 1.3848069459548475,
                            longitude: savedLng || 102.18214794585786
                        });
                    } else if (e.target.classList.contains('input')) {
                        panel.innerHTML = `
                    <div class="mt-4">
                        <x-input-form id="latitude" title="Latitude" tipe="text" value="${savedLat}">
                        </x-input-form>
                    </div>
                    <div class="mt-4">
                        <x-input-form id="longitude" title="Longitude" tipe="text" value="${savedLng}">
                        </x-input-form>
                    </div>
                `;
                    }
                });
            });
        }
    </script>

    <script>
        function initFishTypeSelect(selector, showTypes = true) {
            return $(selector).select2({
                placeholder: "Pilih Jenis Ikan",
                tokenSeparators: [','],
                allowClear: true,
                tags: true,
                ajax: {
                    url: '{{ route('fish-types.search') }}',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: showTypes ? data : data.map(item => ({
                                id: item.nama,
                                text: item.nama,
                                newTag: false
                            }))
                        };
                    },
                    cache: true
                },
                createTag: function(params) {
                    const term = $.trim(params.term);
                    if (term === '') {
                        return null;
                    }

                    // Cek apakah nilai sudah ada di opsi yang ada
                    const exists = $(this).find('option').filter(function() {
                        return $(this).val().toLowerCase() === term.toLowerCase();
                    }).length > 0;

                    if (exists) {
                        return null;
                    }

                    return {
                        id: term,
                        text: term,
                        newTag: true
                    };
                }
            });
        }
    </script>
    @stack('script')
</body>

</html>
