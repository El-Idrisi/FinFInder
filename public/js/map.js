// Buat file baru: public/js/map-initialize.js
function initMap(options = {}) {
    const {
        containerId = 'map',
        latitude = 1.3848069459548475,
        longitude = 102.18214794585786,
        zoom = 10,
        isEditable = false,
        spotData = null,
    } = options;

    let map = L.map(containerId, {
        fullscreenControl: true,
        gestureHandling: true,
    }).setView([latitude, longitude], zoom);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    let currentMarker = null;

    // Jika mode edit
    if (isEditable) {
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

        // Jika ada nilai yang tersimpan
        const savedLat = document.getElementById('latitude')?.value;
        const savedLng = document.getElementById('longitude')?.value;
        if (savedLat && savedLng) {
            currentMarker = L.marker([savedLat, savedLng]).addTo(map);
            currentMarker.bindPopup("Latitude: " + savedLat + "<br>Longitude: " + savedLng).openPopup();
        }
    }

    // Jika mode view (dengan data spot)
    if (spotData) {
        const marker = L.marker([spotData.latitude, spotData.longitude]).addTo(map);
        marker.bindPopup(spotData.popupContent);

        // Tambahkan coordinate display
        const coordDisplay = L.control({ position: 'topright' });
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
// Tambahkan fungsi untuk menangani tabs jika diperlukan

function halo()
{
    alert('Halo');
}
