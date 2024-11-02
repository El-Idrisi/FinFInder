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
                        <tbody class="rounded-md" id="table-body">
                            @foreach ($fishdatas as $fishspot)
                                <tr class="w-full transition-all ">
                                    <td class="py-3">{{ $loop->iteration }}</td>
                                    <td class="py-3 ">
                                        <div class="flex flex-wrap gap-2 min-w-[300px] max-w-[400px]">
                                            @foreach ($fishspot->getFishTypes() as $ikan)
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
                                            class="px-4 py-2 transition-all duration-300 bg-green-500 rounded-md text-slate-100 hover:bg-green-600">{{ ucwords($fishspot->status) }}</span>
                                    </td>
                                    <td class="py-3">
                                        <a href="{{ route('preview.data', $fishspot) }}"
                                            class="p-2 transition-all duration-300 rounded-md cursor-pointer bg-sky-500 text-slate-100 hover:bg-sky-600"><i
                                                class=" fa-solid fa-magnifying-glass"></i></a>
                                    </td>
                                </tr>
                                <tr class="w-full transition-all ">
                                    <td class="py-3">{{ $loop->iteration }}</td>
                                    <td class="py-3 ">
                                        <div class="flex flex-wrap gap-2 min-w-[300px] max-w-[400px]">
                                            @foreach ($fishspot->getFishTypes() as $ikan)
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
                                            class="px-4 py-2 transition-all duration-300 bg-green-500 rounded-md text-slate-100 hover:bg-green-600">{{ ucwords($fishspot->status) }}</span>
                                    </td>
                                    <td class="py-3">
                                        <a href="{{ route('preview.data', $fishspot) }}"
                                            class="p-2 transition-all duration-300 rounded-md cursor-pointer bg-sky-500 text-slate-100 hover:bg-sky-600"><i
                                                class=" fa-solid fa-magnifying-glass"></i></a>
                                    </td>
                                </tr>
                                <tr class="w-full transition-all ">
                                    <td class="py-3">{{ $loop->iteration }}</td>
                                    <td class="py-3 ">
                                        <div class="flex flex-wrap gap-2 min-w-[300px] max-w-[400px]">
                                            @foreach ($fishspot->getFishTypes() as $ikan)
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
                                            class="px-4 py-2 transition-all duration-300 bg-green-500 rounded-md text-slate-100 hover:bg-green-600">{{ ucwords($fishspot->status) }}</span>
                                    </td>
                                    <td class="py-3">
                                        <a href="{{ route('preview.data', $fishspot) }}"
                                            class="p-2 transition-all duration-300 rounded-md cursor-pointer bg-sky-500 text-slate-100 hover:bg-sky-600"><i
                                                class=" fa-solid fa-magnifying-glass"></i></a>
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
            $('#fishTable').DataTable({
                responsive: true,
                language: {
                    url: '/datatable-language',
                    search: `<i class="fas fa-search"></i>`,
                    paginate: {
                        next: '<i class="fas fa-chevron-right"></i>',
                        previous: '<i class="fas fa-chevron-left"></i>',
                    }
                },
                columnDefs: [{
                    targets: [5, 4], // kolom aksi
                    orderable: false
                }],
                dom: '<"flex justify-between flex-wrap items-center mb-4"lf>rt<"flex justify-end items-center mt-4"p>',
                initComplete: function() {
                    $('.dataTables_filter input').attr('placeholder', 'Cari data...');
                    $('.dataTables_filter input').addClass('pl-10 border rounded-lg');
                },
            });
        });
    </script>
@endpush
