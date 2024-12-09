// Definisi basemap dan URL nya
const basemapUrls = {
    osm: {
        url: 'https://tile.openstreetmap.org/{z}/{x}/{y}.png',
        options: {
            maxZoom: 19,
            noWrap: true, // Mencegah peta berulang secara horizontal
            bounds: [
                [-90, -180],
                [90, 180]
            ],
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }
    },
    satelite: {
        url: 'http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}',
        options: {
            maxZoom: 20,
            noWrap: true, // Mencegah peta berulang secara horizontal
            bounds: [
                [-90, -180],
                [90, 180]
            ],
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        }
    },
    ocean: {
        url: 'https://server.arcgisonline.com/ArcGIS/rest/services/Ocean/World_Ocean_Base/MapServer/tile/{z}/{y}/{x}',
        options: {
            noWrap: true, // Mencegah peta berulang secara horizontal
            bounds: [
                [-90, -180],
                [90, 180]
            ],
            attribution: 'Tiles &copy; Esri &mdash; Sources: GEBCO, NOAA, CHS, OSU, UNH, CSUMB, National Geographic, DeLorme, NAVTEQ, and Esri'
        }
    },
    voyager: {
        url: 'https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}.png',
        options: {
            noWrap: true, // Mencegah peta berulang secara horizontal
            bounds: [
                [-90, -180],
                [90, 180]
            ],
            maxZoom: 19,
            attribution: '© CartoDB'
        }
    }
};

// Buat layer untuk peta utama
var baseMaps = {
    osm: L.tileLayer(basemapUrls.osm.url, basemapUrls.osm.options),
    satelite: L.tileLayer(basemapUrls.satelite.url, basemapUrls.satelite.options),
    ocean: L.tileLayer(basemapUrls.ocean.url, basemapUrls.ocean.options),
    voyager: L.tileLayer(basemapUrls.voyager.url, basemapUrls.voyager.options)
};
