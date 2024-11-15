<div class="overflow-hidden bg-white rounded-lg shadow-lg tilt" style="transform-style: preserve-3d;">
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
            <div class="flex items-start gap-2">
                <i class="mt-1 text-gray-500 fa-solid fa-calendar-days"></i>
                <span>Dibuat Pada Tanggal: {{ $date }}</span>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col gap-2 mt-4">
            <a href="{{ route('verifikasi.show', $idMap) }}"
                class="flex items-center justify-center w-full px-4 py-2 text-white transition-all duration-300 rounded-md cursor-pointer view-btn bg-sky-500 hover:bg-sky-600 hover:scale-105 group">
                <i class="mr-2 transition-transform fas fa-eye group-hover:rotate-12"></i>
                <span class="transition-all group-hover:font-bold">Lihat Selengkapnya</span>
            </a>

            <div class="flex gap-2">
                <form class="inline w-full" action="{{ route('verifikasi.update-status', $idMap) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="disetujui">
                    <button
                        class="flex-1 w-full px-4 py-2 text-white transition-all duration-300 bg-green-500 rounded-md approve-btn hover:bg-green-600 hover:scale-105 group">
                        <i class="mr-2 transition-all fas fa-check group-hover:rotate-12"></i>
                        <span class="transition-all group-hover:font-bold">Setuju</span>
                    </button>
                </form>

                <form class="inline w-full" action="{{ route('verifikasi.update-status', $idMap) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="ditolak">
                    <button
                        class="flex-1 w-full px-4 py-2 text-white transition-all duration-300 bg-red-500 rounded-md reject-btn hover:bg-red-600 hover:scale-105 group">
                        <i class="mr-2 transition-all fas fa-times group-hover:rotate-12"></i>
                        <span class="transition-all group-hover:font-bold">Tolak</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
