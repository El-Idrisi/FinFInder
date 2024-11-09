@extends('layouts.dashboard')

@section('content')
    <div class="mb-8">
        <h2 class="mb-2 text-3xl font-bold">Data Ikan</h2>
        <a href="/dashboard"
            class="after:content-['>'] transition-all duration-300 after:text-black after:px-2 hover:text-slate-500">Dashboard</a>
        <p class="inline text-slate-500">Data Ikan</p>

        <div class="relative mt-4 bg-white">
            <div class="px-4 py-2 border-b-2 border-slate-200">
                <h4 class="font-bold">Keseluruhan Data</h4>
            </div>
            <div class="relative px-4 py-4">
                <div class="relative p-3 overflow-x-auto sm:rounded-lg">
                    <table id="fishTable" class="w-full text-sm text-left row-border order-column stripe">
                        <thead class="rounded-md bg-sky-300">
                            <tr class="">
                                <th class="py-3 rounded-tl-md">
                                    No
                                </th>
                                <th class="py-3 cursor-pointer sort-header" data-sort="fish_type">
                                    Jenis Ikan
                                </th>
                                <th class="py-3">
                                    Diinput Oleh
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
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {

            const table = $('#fishTable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: "{{ route('data-ikan') }}", // Sesuaikan dengan route Anda
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: true, // Ubah menjadi true
                        searchable: false,
                    },
                    {
                        data: 'jenis_ikan',
                        name: 'jenis_ikan'
                    },
                    {
                        data: 'dibuat_oleh',
                        name: 'dibuat_oleh'
                    },
                    {
                        data: 'koordinat',
                        name: 'koordinat'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        orderable: false,
                        searchable: false
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
        });
    </script>
@endpush
