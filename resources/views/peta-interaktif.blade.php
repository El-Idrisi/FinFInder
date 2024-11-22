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

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

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
        .leaflet-control-attribution.dark {
            filter: invert(100%) hue-rotate(180deg) brightness(95%) contrast(90%);
        }
    </style>
</head>

<body>



    <div id="map" class="w-screen h-screen bg-slate-200"></div>

    <script>
        var map = L.map('map').setView([1.3848069459548475, 102.18214794585786], 10);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        var spots = @json($spots);
        console.log(spots);

        spots.forEach(function(spot) {
            let fishArray = spot.fishes;
            if (typeof spot.fishes === 'string') {
                try {
                    fishArray = JSON.parse(spot.fishes);
                } catch (e) {
                    fishArray = [spot.fishes];
                }
            }

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
</body>

</html>
