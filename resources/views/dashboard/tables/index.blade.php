@extends('layouts.dashboard')

@section('content')
    <div class="mb-8">
        <h2 class="mb-2 text-3xl font-bold">Data Anda</h2>
        <a href="/dashboard"
            class="after:content-['>'] transition-all duration-300 after:text-black after:px-2 hover:text-slate-500">Dashboard</a>
        <p class="inline text-slate-500">Data Anda</p>

        <div class="relative mt-4 bg-white">
            <div class="px-4 py-2 border-b-2 border-slate-200">
                <h4 class="font-bold">Keseluruhan Data</h4>
            </div>
            <div class="relative px-4 py-4">
                <div class="relative p-3 overflow-x-auto sm:rounded-lg">
                    <table id="fishTable" class="w-full text-sm text-left row-border order-column stripe"
                        style="width: 100%">
                        <thead class="rounded-md bg-sky-300">
                            <tr class="">
                                <th class="py-3 rounded-tl-md">
                                    No
                                </th>
                                <th class="py-3">
                                    Jenis Ikan
                                </th>
                                <th class="py-3">
                                    Di Buat Pada Tanggal
                                </th>
                                <th class="py-3">
                                    Koordinat
                                </th>
                                <th class="py-3">
                                    Status
                                </th>
                                <th class="py-3 rounded-tr-md">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        {{-- <tbody class="rounded-md" id="table-body">
                            @foreach ($fishdatas as $fishspot)
                                <tr class="w-full transition-all ">
                                    <td class="py-3">{{ $loop->iteration }}</td>
                                    <td class="py-3 ">
                                        <div class="flex flex-wrap gap-2 lg:min-w-[300px] lg:max-w-[400px]">
                                            @foreach ($fishspot->getFishTypes(5) as $ikan)
                                                <span
                                                    class="px-3 py-1 text-sm transition-all duration-300 border rounded-md border-sky-500 hover:bg-sky-100">
                                                    {{ $ikan->nama }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td class="py-3">{{ $fishspot->creator->username }}</td>
                                    <td class="py-3">{{ $fishspot->latitude . ' , ' . $fishspot->longitude }}</td>
                                    <td class="py-3">
                                        <span
                                            class="px-4 py-2 transition-all duration-300 rounded-md text-slate-100 font-bold {{ $fishspot->status == 'disetujui' ? 'bg-green-500 hover:bg-green-600' : ($fishspot->status == 'ditunda' ? 'bg-yellow-500 hover:bg-yellow-600' : 'bg-red-500 hover:bg-red-600') }}">{{ ucwords($fishspot->status) }}</span>
                                    </td>
                                    <td class="flex gap-2 py-3">
                                        <a href="{{ route('preview.data', $fishspot) }}"
                                            class="p-2 px-3 transition-all duration-300 rounded-md cursor-pointer bg-sky-500 text-slate-100 hover:bg-sky-600"><i
                                                class=" fa-solid fa-magnifying-glass"></i></a>
                                        <a href="{{ route('fish.showEdit', $fishspot) }}"
                                            class="p-2 px-3 transition-all duration-300 bg-yellow-500 rounded-md cursor-pointer text-slate-100 hover:bg-yellow-600"><i
                                                class="fa-solid fa-pen-to-square"></i></a>
                                        <form method="POST" class="inline delete-spotikan" action="{{ route('fish.delete', $fishspot->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-2 px-3 transition-all duration-300 bg-red-500 rounded-md cursor-pointer text-slate-100 hover:bg-red-600">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody> --}}
                    </table>
                    {{-- {{ $dataTable->table() }} --}}
                </div>
            </div>

        </div>
    </div>
@endsection

@push('script')
    {{-- {{ $dataTable->scripts(attributes: ['type' => 'module']) }} --}}
    <script>
        $(document).ready(function() {
            const table = $('#fishTable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "{{ route('data.index') }}", // Sesuaikan dengan route Anda
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: true, // Ubah menjadi true
                        searchable: false,
                        // Tambahkan ini untuk custom sorting
                        render: function(data, type, row, meta) {
                            if (type === 'display') {
                                return data;
                            }
                            return meta.row + 1; // Gunakan index baris untuk sorting
                        }
                    },
                    {
                        data: 'jenis_ikan',
                        name: 'jenis_ikan'
                    },
                    {
                        data: 'dibuat_pada_tanggal',
                        name: 'dibuat_pada_tanggal'
                    },
                    {
                        data: 'koordinat',
                        name: 'koordinat'
                    },
                    {
                        data: 'status',
                        name: 'status'
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                        orderable: false,
                        searchable: false
                    }
                ],
                columnDefs: [{
                    responsivePriority: 1,
                    targets: [0,1, 5]
                }, ],
                language: {
                    url: '{{ asset('js/datatables-id.json') }}',
                    search: '<i class="fas fa-search"></i>',
                    searchPlaceholder: "Cari data...",
                    paginate: {
                        next: '<i class="fas fa-chevron-right"></i>',
                        previous: '<i class="fas fa-chevron-left"></i>',
                    }
                },
                dom: '<"flex justify-between flex-wrap items-center mb-4"lf>rt<"flex justify-end items-center mt-4"p>',
                initComplete: function() {
                    $('.dataTables_filter input').addClass('pl-10 border rounded-lg');
                }
            });

            $('#fishTable').on('submit', '.delete-spotikan', function(e) {
                e.preventDefault();
                const form = $(this);
                const url = form.attr('action');

                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "Data yang dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#EF4444',
                    cancelButtonColor: '#6B7280',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: {
                                '_token': $('meta[name="csrf-token"]').attr('content'),
                                '_method': 'DELETE'
                            },
                            success: function(response) {
                                // Tampilkan pesan sukses
                                Swal.fire(
                                    'Terhapus!',
                                    'Data berhasil dihapus.',
                                    'success'
                                );

                                // Reload DataTable
                                $('#fishTable').DataTable().ajax.reload();
                            },
                            error: function(xhr) {
                                // Tampilkan pesan error
                                Swal.fire(
                                    'Error!',
                                    'Terjadi kesalahan saat menghapus data.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });
        });
    </script>
@endpush
