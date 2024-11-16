@extends('layouts.dashboard')

@section('content')
    <div class="mb-8">
        <h2 class="mb-2 text-3xl font-bold">Data Anda</h2>
        <a href="/dashboard"
            class="after:content-['>'] transition-all duration-300 after:text-black after:px-2 hover:text-slate-500">Dashboard</a>
        <p class="inline text-slate-500">Data Anda</p>

        <div class="relative mt-4 shadow-md bg-white-100">
            <div class="px-4 py-2 border-b-2 border-slate-200">
                <h4 class="font-bold">Keseluruhan Data</h4>
            </div>
            <div class="relative px-4 py-4">
                <div class="relative p-3 overflow-x-auto sm:rounded-lg">
                    <table id="fishTable" class="w-full text-sm text-left row-border order-column stripe"
                        style="width: 100%">
                        <thead class="rounded-md bg-sky-300">
                            <tr class="">
                                <th class="py-3 rounded-tl-md">No</th>
                                <th class="py-3 cursor-pointer sort-header" data-sort="fish_type">Jenis Ikan</th>
                                <th class="py-3">Dibuat Pada Tanggal</th>
                                <th class="py-3">Koordinat</th>
                                <th class="py-3">Status</th>
                                <th class="py-3 rounded-tr-md">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="rounded-md" id="table-body">
                            @foreach ($fishdatas as $fishspot)
                                <tr class="w-full transition-all">
                                    <td class="py-3">{{ $loop->iteration }}</td>
                                    {{-- Jenis Ikan Cell --}}
                                    <td class="py-3">
                                        <div class="flex flex-wrap gap-2 lg:w-[300px]"> {{-- Tetapkan lebar tetap --}}
                                            @foreach ($fishspot->getFishTypes(5) as $ikan)
                                                <span
                                                    class="px-3 py-1 text-sm transition-all duration-300 border rounded-md border-sky-500 hover:bg-sky-100">
                                                    {{ $ikan->nama }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td class="py-3">{{ $fishspot->created_at->translatedFormat('d F Y') }}</td>
                                    <td class="py-3">{{ $fishspot->latitude . ' , ' . $fishspot->longitude }}</td>
                                    {{-- Status Cell --}}
                                    <td class="py-3">
                                        <div class="flex items-center"> {{-- Tambahkan flex container --}}
                                            <span
                                                class="px-4 py-2 transition-all duration-300 rounded-md text-slate-100 font-bold
                                                {{ $fishspot->status == 'disetujui'
                                                    ? 'bg-green-500 hover:bg-green-600'
                                                    : ($fishspot->status == 'ditunda'
                                                        ? 'bg-yellow-500 hover:bg-yellow-600'
                                                        : 'bg-red-500 hover:bg-red-600') }}">
                                                {{ ucwords($fishspot->status) }}
                                            </span>
                                        </div>
                                    </td>
                                    {{-- Action Cell --}}
                                    <td class="py-3">
                                        <div class="flex items-center gap-2"> {{-- Tambahkan flex container dengan items-center --}}
                                            <a href="{{ route('data-anda.show', $fishspot) }}"
                                                class="p-2 px-3 transition-all duration-300 rounded-md cursor-pointer bg-sky-500 text-slate-100 hover:bg-sky-600">
                                                <i class="fa-solid fa-magnifying-glass"></i>
                                            </a>
                                            <a href="{{ route('data-anda.showEdit', $fishspot) }}"
                                                class="p-2 px-3 transition-all duration-300 bg-yellow-500 rounded-md cursor-pointer text-slate-100 hover:bg-yellow-600">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <form method="POST" class="inline delete-spotikan"
                                                action="{{ route('data-anda.delete', $fishspot->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="p-2 px-3 transition-all duration-300 bg-red-500 rounded-md cursor-pointer text-slate-100 hover:bg-red-600">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {

            $('.delete-spotikan').submit(function(e) {
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
                    console.log('delete-spotikan');
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            })

            function isMobile() {
                return window.innerWidth < 768;
            }

            const table = $('#fishTable').DataTable({
                responsive: true,
                language: {
                    url: '{{ asset('js/datatables-id.json') }}',
                    search: `<i class="fas fa-search"></i>`,
                    paginate: {
                        next: '<i class="fas fa-chevron-right"></i>',
                        previous: '<i class="fas fa-chevron-left"></i>',
                    }
                },
                columnDefs: [{
                    targets: [5], // kolom aksi
                    orderable: false
                }, {
                    // Hanya tampilkan No dan Jenis Ikan
                    responsivePriority: 1,
                    targets: [0, 1, 5]
                }, ],
                dom: '<"flex justify-between flex-wrap items-center mb-4"lf>rt<"flex justify-end items-center mt-4"p>',
                initComplete: function() {
                    $('.dataTables_filter input').attr('placeholder', 'Cari data...');
                    $('.dataTables_filter input').addClass('pl-10 border rounded-lg');

                    if (isMobile()) {
                        table.rows().every(function() {
                            this.child.show();
                            $(this.node()).addClass('parent shown');
                            // Rotate icon saat expanded
                            $(this.node()).find('td:first i').addClass('rotate-90');
                        });
                    }
                },
            });
        });
    </script>
@endpush
