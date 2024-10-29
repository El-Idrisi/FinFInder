@extends('layouts.dashboard')

@section('content')
    <div class="container p-6 mx-auto">
        <div class="flex flex-wrap items-center justify-between mb-6">
            <div class="mb-4 lg:mb-0">
                <h1 class="mb-2 text-2xl font-bold text-gray-800">Daftar Jenis Ikan</h1>
                <a href="/dashboard"
                    class="after:content-['>'] transition-all duration-300 after:text-black after:px-2 hover:text-slate-500">Dashboard</a>
                <p class="inline text-slate-500">List Ikan</p>
            </div>
            <button id="add-type"
                class="px-4 py-2 font-bold text-white transition-all duration-300 rounded-lg shadow-md dura bg-sky-500 hover:bg-sky-600 hover:shadow-lg">
                <i class="mr-2 fas fa-plus"></i>Tambah Jenis Ikan
            </button>
        </div>

        <div class="">
            <table class="w-full bg-white">
                <thead>
                    <tr class="bg-sky-300">
                        <th class="px-4 py-2 text-left border-b-2 border-slate-300">No</th>
                        <th class="px-4 py-2 text-left border-b-2 border-slate-300">Jenis Ikan</th>
                        <th class="px-4 py-2 text-left border-b-2 border-slate-300">Aksi</th>
                    </tr>
                </thead>
                @php
                    $i = 1;
                @endphp
                <tbody>
                    @foreach ($fishTypes as $fish)
                        <tr class="transition-all duration-300">
                            <td class="px-4 py-2 text-left border-b-2 !rounded-none border-slate-300">{{ $i++ }}
                            </td>
                            <td class="px-4 py-2 text-left border-b-2 border-slate-300">{{ $fish->nama }}</td>
                            <td class="flex px-4 py-2 text-left border-b-2 !rounded-none border-slate-300">
                                <a href="#"
                                    class="flex items-center justify-center p-2 transition-all duration-300 bg-yellow-500 rounded-md text-slate-100 w-fit hover:bg-yellow-600">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <span class="mx-2">|</span>
                                <form action="{{ route('list-ikan.delete', $fish->id) }}" method="GET" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="flex items-center justify-center p-2 transition-all duration-300 bg-red-500 rounded-md text-slate-100 w-fit hover:bg-red-600">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div id="modal-add-type" class="fixed inset-0 z-[9999] hidden ">
        <div class="fixed inset-0 bg-black/50" id="modal-overlay"></div>
        <div class="fixed w-full max-w-md -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
            <div class="bg-white rounded-lg shadow-lg">
                <!-- Header Modal -->
                <div class="px-6 py-4 text-white border-b rounded-t-lg border-slate-200 bg-sky-800">
                    <h3 class="text-xl font-bold">Tambah Jenis Ikan</h3>
                </div>

                <!-- Body Modal -->
                <div class="px-6 py-4">
                    <form id="form-add-type">
                        @csrf
                        <div class="mb-4">
                            <label for="fish_type" class="block mb-2 font-bold">Jenis Ikan</label>
                            <select id="fish_type" name="fish_type[]" class="w-full" multiple>
                            </select>
                            <small class="text-slate-500">Ketik untuk menambahkan jenis ikan baru</small>
                            <small id="error" class="block text-red-500"></small>
                        </div>
                    </form>
                </div>

                <!-- Footer Modal -->
                <div class="flex justify-end gap-2 px-6 py-4 border-t border-slate-200">
                    <button id="close-modal"
                        class="px-4 py-2 font-bold transition-colors duration-300 rounded-lg text-slate-500 hover:bg-slate-100">
                        Batal
                    </button>
                    <button type="submit" form="form-add-type"
                        class="px-4 py-2 font-bold text-white transition-colors duration-300 rounded-lg bg-sky-500 hover:bg-sky-600">
                        Simpan
                    </button>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('style')
    {{-- select2 css --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    {{-- select2.js --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush

@push('script')
    <script>
        $(document).ready(function() {

            initFishTypeSelect('#fish_type', false);

            $('#add-type').click(function() {
                $('#modal-add-type').removeClass('hidden');
            });

            $('#close-modal, #modal-overlay').click(function() {
                $('#modal-add-type').addClass('hidden');
                $('#fish_type').val(null).trigger('change'); // Reset select2
            });

            $('.modal-content').click(function(e) {
                e.stopPropagation();
            });

            $('#form-add-type').submit(function(e) {
                e.preventDefault();

                const selectedTypes = $('#fish_type').val();

                if (!selectedTypes || selectedTypes.length === 0) {
                    $('#error').text('Pilih minimal satu jenis ikan');
                    return;
                }

                $.ajax({
                    url: '{{ route('list-ikan.create') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        types: selectedTypes
                    },
                    success: function(response) {
                        $('#modal-add-type').addClass('hidden');
                        $('#fish_type').val(null).trigger('change'); // Reset select2

                        // Tampilkan pesan sukses dan refresh data jika perlu
                        Swal.fire({
                            title: "Berhasil!",
                            text: "Jenis ikan berhasil ditambahkan",
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            location.reload(); // Reload setelah sweetalert hilang
                        });
                    },
                    error: function(xhr) {
                        Swal.fire({
                            title: "Error!",
                            text: xhr.responseJSON?.message || 'Terjadi kesalahan',
                            icon: "error",
                            confirmButtonText: "OK",
                            confirmButtonColor: "#0EA5E9"
                        });
                    }
                });
            });
        });
    </script>
@endpush
