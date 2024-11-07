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
                    <tr class="flex bg-sky-300">
                        <th class="w-full px-4 py-2 text-left border-b-2 border-slate-300">No</th>
                        <th class="w-full px-4 py-2 text-left border-b-2 border-slate-300">Jenis Ikan</th>
                        <th class="w-full px-4 py-2 text-left border-b-2 border-slate-300">Aksi</th>
                    </tr>
                </thead>
                <tbody class="w-full">
                    @foreach ($fishTypes as $fish)
                        <tr class="flex items-center w-full duration-300 ransition-all">
                            <td class="w-full  px-4 py-2 text-left  !rounded-none ">{{ $loop->iteration }}
                            </td>
                            <td class="w-full py-2 text-left tpx-4 ">{{ $fish->nama }}</td>
                            <td class="flex w-full  px-4 py-2 text-left gap-4  !rounded-none ">
                                <a href="{{ route('list-ikan.sort', $fish->id) }}"
                                    class="flex items-center justify-center p-2 transition-all duration-300 rounded-md bg-sky-500 text-slate-100 w-fit hover:bg-sky-600 h-fit">
                                    <i class="fas fa-search"></i>
                                </a>
                                <a href="#"
                                    class="flex items-center justify-center p-2 transition-all duration-300 bg-yellow-500 rounded-md h-fit w-fit btn-edit text-slate-100 hover:bg-yellow-600"
                                    data-namaIkan="{{ $fish->nama }}" data-idIkan="{{ $fish->id }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('list-ikan.delete', $fish->id) }}" method="GET"
                                    class="inline delete-ikan">
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

    {{-- <div id="modal-add-type" class="fixed inset-0 z-[9999] hidden ">
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
    </div> --}}
    <x-modal title="Tambah Jenis Ikan" idModal="modal-add-type" idForm="form-add-type">
        <div class="mb-4">
            <label for="fish_type" class="block mb-2 font-bold">Jenis Ikan</label>
            <select id="fish_type" name="fish_type[]" class="w-full" multiple>
            </select>
            <small class="text-slate-500">Ketik untuk menambahkan jenis ikan baru</small>
            <small id="error" class="block text-red-500"></small>
        </div>
    </x-modal>

    <x-modal title="Edit Jenis Ikan" idModal="modal-edit-type" idForm="form-edit-type">
        <div class="mb-4">
            @method('PUT')
            <label for="edit-fish_type" class="block mb-2 font-bold">Jenis Ikan</label>
            <input type="text" name="fish_type" id="edit-fish_type"
                class="w-full p-2 border rounded-md border-slate-300">
            <small class="text-slate-500">Ketik untuk meng-edit jenis ikan</small>
            <small id="error" class="block text-red-500"></small>
        </div>
    </x-modal>
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
            $('.delete-ikan').submit(function(e) {
                e.preventDefault();
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            })
        });
    </script>
    <script>
        $(document).ready(function() {

            initFishTypeSelect('#fish_type', false);

            $('#close-modal, #modal-overlay').click(function() {
                $('#modal-add-type').addClass('hidden');
                $('#modal-edit-type').addClass('hidden');
                $('#fish_type').val(null).trigger('change'); // Reset select2
            });

            $('.modal-content').click(function(e) {
                e.stopPropagation();
            });

            $('.btn-edit').click(function() {
                var IdIkan = $(this).attr('data-idIkan');

                console.log($(this).attr('data-namaIkan'), $(this).attr('data-idIkan'))

                $('#modal-edit-type').removeClass('hidden');
                console.log($('#edit-fish_type'));
                $('#edit-fish_type').val($(this).attr('data-namaIkan'))

                $('#form-edit-type').attr('method', 'POST');
                $('#form-edit-type').attr('action', `/list-ikan/update/${IdIkan}`);
            });

            $('#add-type').click(function() {
                $('#modal-add-type').removeClass('hidden');
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
