function findNearestPoints(searchLocation) {
    // Array untuk menyimpan semua titik dan jaraknya
    const distances = spots.map(spot => {
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

    // Ambil 5 titik terdekat
    const nearestPoints = distances.slice(0);

    // Tampilkan hasil
    showNearestPoints(searchLocation, nearestPoints);
    return nearestPoints;
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
    // map.fitBounds(bounds, { padding: [50, 50] });

}
