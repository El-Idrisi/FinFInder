function findNearestPoints(searchLocation) {
    // Dapatkan daftar ikan yang sedang dicentang
    const checkedFishes = Array.from(document.querySelectorAll('.fish-type-checkbox:checked'))
        .map(checkbox => checkbox.id.replace('ikan-', ''));

    // Filter spots berdasarkan ikan yang dicentang
    const visibleSpots = spots.filter(spot =>
        spot.fishes.some(fish => checkedFishes.includes(fish))
    );

    // Jika tidak ada spot yang visible, return array kosong
    if (visibleSpots.length === 0) {
        return [];
    }

    // Hitung jarak hanya untuk spot yang visible
    const distances = visibleSpots.map(spot => {
        // Hitung jarak menggunakan method Leaflet
        const distance = map.distance(
            searchLocation,
            [spot.latitude, spot.longitude]
        );

        return {
            spot: spot,
            distance: distance / 1000 // Konversi ke kilometer
        };
    });

    // Urutkan berdasarkan jarak terdekat
    distances.sort((a, b) => a.distance - b.distance);

    return distances;
}

function showNearestPoints(searchLocation, nearestPoints) {
    // Hapus polyline yang lama jika ada
    if (window.distanceLines) {
        window.distanceLines.forEach(line => map.removeLayer(line));
    }
    window.distanceLines = [];

    // Ambil hanya titik terdekat (index 0)
    const nearestPoint = nearestPoints[0];

    // Buat polyline untuk titik terdekat
    const line = L.polyline([
        searchLocation,
        [nearestPoint.spot.latitude, nearestPoint.spot.longitude]
    ], {
        color: '#2563eb',  // Warna biru untuk garis
        weight: 3,         // Ketebalan garis
        opacity: 0.8,      // Transparansi
        dashArray: '10, 10' // Pola garis putus-putus
    }).addTo(map);

    // Tambahkan popup dengan informasi jarak
    line.bindPopup(`
        <div class="text-center">
            <p class="font-bold">Jarak Terdekat: ${nearestPoint.distance.toFixed(2)} km</p>
            <p>Ke lokasi: ${nearestPoint.spot.description || 'Titik Terdekat'}</p>
        </div>
    `).openPopup();

    window.distanceLines.push(line);

    // Sesuaikan tampilan peta untuk menampilkan garis
    const bounds = L.latLngBounds([
        searchLocation,
        [nearestPoint.spot.latitude, nearestPoint.spot.longitude]
    ]);
    map.fitBounds(bounds, { padding: [50, 50] });

}

function sleep(time) {
    return new Promise((resolve) => setTimeout(resolve, time));
}
