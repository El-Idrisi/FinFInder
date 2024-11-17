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

        <div class="my-6 space-y-4">
            <form method="GET" id="filterForm">
                <div
                    class="flex flex-col px-4 py-2 border rounded-md shadow bg-white-100 border-slate-300 md:flex-row md:items-center md:justify-between md:gap-4">
                    <div class="w-full mb-3 md:mb-0 md:w-auto">
                        <label for="count"
                            class="block mb-1 text-sm font-medium text-gray-700 md:inline md:mr-2">Tampilkan</label>
                        <select name="count" id="count"
                            class="w-full h-[38px] px-2 pr-6 border rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500 md:w-20">
                            <option value="10" {{ request('count') == '10' ? 'selected' : '' }}>10</option>
                            <option value="25" {{ request('count') == '25' ? 'selected' : '' }}>25</option>
                            <option value="50" {{ request('count') == '50' ? 'selected' : '' }}>50</option>
                            <option value="100" {{ request('count') == '100' ? 'selected' : '' }}>100</option>
                        </select>
                    </div>

                    <div class="flex flex-col gap-3 md:flex-row md:items-center md:gap-4">
                        <div class="px-4 py-2 border rounded-md border-slate-400">
                            <label for="search" class="mr-2"><i
                                    class="fa-solid fa-magnifying-glass text-slate-400"></i></label>
                            <input type="search" name="search" id="search" value="{{ request('search') }}"
                                class="outline-0" placeholder="Cari Jenis Ikan..." autofocus>
                        </div>

                        <div class="flex items-center gap-2">
                            <select name="sort" id="sort"
                                class="flex-1 h-[38px] px-4 border rounded-lg focus:outline-none focus:ring-2 focus:ring-sky-500 md:flex-none">
                                <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>Terbaru
                                </option>
                                <option value="terlama" {{ request('sort') == 'terlama' ? 'selected' : '' }}>Terlama
                                </option>
                                <option value="A-Z" {{ request('sort') == 'A-Z' ? 'selected' : '' }}>A-Z
                                </option>
                                <option value="Z-A" {{ request('sort') == 'Z-A' ? 'selected' : '' }}>Z-A
                                </option>
                            </select>

                            <a href="{{ route('list-ikan.index') }}"
                                class="h-[38px] px-4 py-2 text-sm text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200">
                                Reset
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="">
            <div class="container mx-auto mb-8">
                <div class="rounded-lg shadow-md bg-white-100">
                    @foreach ($fishTypes as $fish)
                        <div
                            class="flex items-center justify-between p-4 transition-all duration-300 border-b hover:bg-gray-50">
                            <div class="flex items-center gap-4">
                                <div
                                    class="flex items-center justify-center w-10 h-10 rounded-full bg-sky-100 text-sky-500">
                                    <i class="fas fa-fish"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold fish-name">{{ $fish->nama }}</h3>
                                    <div class="text-sm text-gray-600">
                                        {{ $fish->hitungSpotIkan() ?? 0 }} Lokasi •
                                        {{ $fish->hitungSpotIkanTerverifikasi() ?? 0 }} Terverifikasi
                                    </div>
                                </div>
                            </div>

                            <div class="flex gap-2">
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
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{ $fishTypes->withQueryString()->links() }}
    </div>

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
        document.addEventListener('DOMContentLoaded', function() {
            const filterForm = document.getElementById('filterForm');
            const searchInput = document.getElementById('search');
            const countSelect = document.getElementById('count');
            const sortSelect = document.getElementById('sort');

            // Fungsi untuk menerapkan filter dengan delay
            let timeoutId;

            function applyFilters() {
                clearTimeout(timeoutId);
                timeoutId = setTimeout(() => {
                    filterForm.submit();
                }, 300); // Delay 500ms
            }

            // Event listener untuk search dengan debounce
            searchInput.addEventListener('input', applyFilters);

            // Event listener untuk select
            countSelect.addEventListener('change', () => filterForm.submit());
            sortSelect.addEventListener('change', () => filterForm.submit());
        });
    </script>

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

            // $('.btn-edit').click(function() {
            //     var IdIkan = $(this).attr('data-idIkan');

            //     console.log($(this).attr('data-namaIkan'), $(this).attr('data-idIkan'))

            //     $('#modal-edit-type').removeClass('hidden');
            //     console.log($('#edit-fish_type'));
            //     $('#edit-fish_type').val($(this).attr('data-namaIkan'))

            //     $('#form-edit-type').attr('method', 'POST');
            //     $('#form-edit-type').attr('action', `/list-ikan/update/${IdIkan}`);
            // });

            $('.btn-edit').click(function() {
                const idIkan = $(this).attr('data-idIkan');
                const namaIkan = $(this).attr('data-namaIkan');

                $('#modal-edit-type').removeClass('hidden');
                $('#edit-fish_type').val(namaIkan);
                $('#form-edit-type').data('id', idIkan); // Simpan ID untuk digunakan saat submit
            });

            // Handle form submit
            $('#form-edit-type').submit(function(e) {
                e.preventDefault();

                const idIkan = $(this).data('id');
                const fishType = $('#edit-fish_type').val();

                // Reset error
                $('#error').text('');

                // Validasi
                if (!fishType) {
                    $('#error').text('Jenis ikan harus diisi');
                    return;
                }

                // Disable button and show loading
                const submitBtn = $(this).find('button[type="submit"]');
                submitBtn.prop('disabled', true);
                const originalText = submitBtn.html();
                submitBtn.html('<i class="fas fa-spinner fa-spin"></i> Menyimpan...');

                $.ajax({
                    url: `/list-ikan/update/${idIkan}`,
                    type: 'PUT',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        fish_type: fishType
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            // Tampilkan pesan sukses
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: response.message,
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                location.reload(); // Reload setelah sweetalert hilang
                            });

                            // Tutup modal
                            $('#modal-edit-type').addClass('hidden');
                            $('#form-edit-type')[0].reset();
                        }
                    },
                    error: function(xhr) {
                        let errorMessage = 'Terjadi kesalahan';

                        if (xhr.status === 422) {
                            // Error validasi
                            errorMessage = xhr.responseJSON.message;
                            $('#error').text(errorMessage);
                        } else if (xhr.responseJSON && xhr.responseJSON.message) {
                            // Error lainnya
                            errorMessage = xhr.responseJSON.message;
                        }

                        // Tampilkan error dengan SweetAlert
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: errorMessage
                        });
                    },
                });
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
