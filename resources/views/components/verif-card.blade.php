<div class="overflow-hidden bg-white rounded-lg shadow-md">
    <!-- Card Header dengan Map -->
    <div class="relative h-48">
        <div id="map-{{ $idMap }}" class="w-full h-full"></div>
        <span class="absolute px-3 py-1 text-sm text-white bg-yellow-500 rounded-full z-[999] top-2 right-2">
            Belum Diverifikasi
        </span>
    </div>

    <!-- Card Body -->
    <div class="p-4">
        <!-- Jenis Ikan -->
        <div class="mb-4">
            <h3 class="mb-2 font-semibold text-gray-700">Jenis Ikan:</h3>
            <div class="flex flex-wrap gap-2">
                @foreach ($jenisIkan as $ikan)
                    <span class="px-3 py-1 text-sm border rounded-md border-sky-500 hover:bg-sky-100">
                        {{ $ikan->nama }}
                    </span>
                @endforeach
            </div>
        </div>

        <!-- Info -->
        <div class="mb-4 space-y-2">
            <div class="flex items-start gap-2">
                <i class="mt-1 text-gray-500 fas fa-user"></i>
                <span>Diinput oleh: {{ $creator }}</span>
            </div>
            <div class="flex items-start gap-2">
                <i class="mt-1 text-gray-500 fas fa-location-dot"></i>
                <span>{{ $latitude }}, {{ $longitude }}</span>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex gap-2 mt-4">
            <button class="flex-1 px-4 py-2 text-white rounded-md bg-sky-500 hover:bg-sky-600">
                <i class="mr-2 fas fa-eye"></i>View
            </button>
            <button class="flex-1 px-4 py-2 text-white bg-green-500 rounded-md hover:bg-green-600">
                <i class="mr-2 fas fa-check"></i>Setuju
            </button>
            <button class="flex-1 px-4 py-2 text-white bg-red-500 rounded-md hover:bg-red-600">
                <i class="mr-2 fas fa-times"></i>Tolak
            </button>
        </div>
    </div>
</div>
