@extends('layouts.dashboard')

@section('content')
    <div class="mb-8">
        <h2 class="mb-2 text-3xl font-bold">Tambah Data</h2>
        <a href="/dashboard"
            class="after:content-['>'] transition-all duration-300 after:text-black after:px-2 hover:text-slate-500">Dashboard</a>
        <a href="/data-ikan"
            class="after:content-['>'] transition-all duration-300 after:text-black after:px-2 hover:text-slate-500">Data
            Ikan</a>
        <p class="inline text-slate-500">Tambah</p>
    </div>

    <x-form-group :isDelete="false" :isAccordion="false" :allowFooter="false" title="Tambah Data">
        <div class="px-8 py-4">
            <form action="{{ route('fish.create') }}" method="POST">
                @csrf

                <div class="flex flex-col !w-full mb-4">
                    <label for="jenis_ikan" class="mb-2 font-bold">Jenis Ikan</label>
                    <select name="jenis_ikan[]" id="jenis_ikan" class="h-10 border-2 rounded-md border-slate-400"
                        multiple="multiple">
                    </select>
                    <p class="text-red-500">
                        @error('jenis_ikan')
                            {{ $message }}
                        @enderror
                    </p>
                </div>

                <x-textarea-input id="deskripsi" title="Deskripsi"></x-textarea-input>
                <p class="text-red-500">
                    @error('deskripsi')
                        {{ $message }}
                    @enderror
                </p>

                <div class="mt-4">
                    <h4 class="font-bold">Koordinat </h4>
                    <div
                        class="relative flex items-center justify-start w-full text-lg font-bold border-b-2 border-slate-300">
                        <a href="#"
                            class="p-4 text-lg font-bold border-none cursor-pointer text-slate-500 bg-none tabs tab-active map">Map</a>
                        <a href="#"
                            class="p-4 text-lg font-bold border-none cursor-pointer text-slate-500 bg-none tabs input">Input</a>
                        <div
                            class="absolute -bottom-[3px] rounded-md left-0 w-20 h-1 bg-sky-500 transition-all duration-300 line">
                        </div>
                    </div>
                    <div id="panel">
                        <div class="w-full mt-2 border-2 rounded-md h-80 border-slate-400" id="map"></div>

                        <input type="hidden" id="latitude" name="latitude">
                        <input type="hidden" id="longitude" name="longitude">
                        <p class="text-red-500">
                            @error('latitude')
                                {{ $message }}
                            @enderror
                            @error('longitude')
                                {{ $message }}
                            @enderror
                        </p>
                    </div>
                </div>

                <button type="submit"
                    class="w-full py-2 mt-8 text-lg font-bold text-center text-white transition duration-300 rounded-md bg-sky-500 hover:bg-sky-600">Tambah
                    Data</button>
            </form>
        </div>
    </x-form-group>
@endsection

@push('style')
    {{-- leaflet css --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <link href='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/leaflet.fullscreen.css'
        rel='stylesheet' />
    <link rel="stylesheet" href="//unpkg.com/leaflet-gesture-handling/dist/leaflet-gesture-handling.min.css"
        type="text/css">

    {{-- select2 css --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.3.0/ckeditor5.css" />



    {{-- jquery --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    {{-- select2.js --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    {{-- LeafLet.Js --}}
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/Leaflet.fullscreen.min.js'></script>
    <script type="importmap">
        {
            "imports": {
                "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/43.3.0/ckeditor5.js",
                "ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/43.3.0/"
            }
        }
    </script>
    <script src="//unpkg.com/leaflet-gesture-handling"></script>
@endpush

@push('script')
    <script type="module">
        import {
            ClassicEditor,
            Essentials,
            Bold,
            Italic,
            Font,
            Paragraph
        } from 'ckeditor5';

        ClassicEditor
            .create(document.querySelector('#deskripsi'), {
                plugins: [Essentials, Bold, Italic, Font, Paragraph],
                toolbar: [
                    'undo', 'redo', '|', 'bold', 'italic', '|',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
                ]
            })
            .then( /* ... */ )
            .catch( /* ... */ );
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            initMap({
                isEditable: true
            });
            initMapTabs();

        });
        $(document).ready(function() {
            initFishTypeSelect('#jenis_ikan');
        });
    </script>
@endpush
