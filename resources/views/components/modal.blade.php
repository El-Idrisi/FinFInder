<div id="{{ $idModal }}" class="fixed inset-0 z-[9999] hidden ">
    <div class="fixed inset-0 bg-black/50" id="modal-overlay"></div>
    <div class="fixed w-full max-w-md -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
        <div class="bg-white rounded-lg shadow-lg">
            <!-- Header Modal -->
            <div class="px-6 py-4 text-white border-b rounded-t-lg border-slate-200 bg-sky-800">
                <h3 class="text-xl font-bold">{{ $title }}</h3>
            </div>

            <!-- Body Modal -->
            <div class="px-6 py-4">
                <form id="{{ $idForm }}">
                    @csrf
                    {{ $slot }}
                </form>
            </div>

            <!-- Footer Modal -->
            <div class="flex justify-end gap-2 px-6 py-4 border-t border-slate-200">
                <button id="close-modal"
                    class="px-4 py-2 font-bold transition-colors duration-300 rounded-lg text-slate-500 hover:bg-slate-100">
                    Batal
                </button>
                <button type="submit" form="{{ $idForm }}"
                    class="px-4 py-2 font-bold text-white transition-colors duration-300 rounded-lg bg-sky-500 hover:bg-sky-600">
                    Simpan
                </button>
            </div>

        </div>
    </div>
</div>
