@extends('layouts.dashboard')

@section('content')
    <div class="mb-8">
        <h2 class="mb-2 text-3xl font-bold">Tambah Data</h2>
        <a href="/dashboard"
            class="after:content-['>'] transition-all duration-300 after:text-black after:px-2 hover:text-slate-500">Dashboard</a>
        <a href="/data-anda"
            class="after:content-['>'] transition-all duration-300 after:text-black after:px-2 hover:text-slate-500">Data
            Anda</a>
        <p class="inline text-slate-500">Tambah Data</p>
    </div>

    <x-form-group :isDelete="false" :isAccordion="false" :allowFooter="false" title="Tambah Data">
        <div class="px-8 py-4">
            <form id="create-form" action="{{ route('data-anda.create') }}" method="POST">
                @csrf

                <div class="flex flex-col !w-full mb-4">
                    <label for="jenis_ikan" class="mb-2 font-bold after:content-['*'] after:text-red-500">Jenis Ikan</label>
                    <select name="jenis_ikan[]" id="jenis_ikan" class="h-10 border-2 rounded-md border-slate-400"
                        multiple="multiple">
                    </select>
                    <p class="text-red-500">
                        @error('jenis_ikan')
                            {{ $message }}
                        @enderror
                    </p>
                </div>

                <div class="flex flex-col w-full">
                    <label for="deskripsi" class="mb-2 font-bold after:content-['*'] after:text-red-500">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" placeholder="Deskripsi" rows="3"
                        class="p-2 border-2 rounded-md resize-none outline-2 border-slate-400 focus:outline-sky-500"></textarea>
                    @error('deskripsi')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-4">
                    <h4 class="font-bold after:content-['*'] after:text-red-500">Koordinat</h4>
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
                        <small class="text-slate-500">Pilih pada peta untuk menentukan titik lokasi </small>
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
            Paragraph,
            Alignment,
            Underline,
            List
        } from 'ckeditor5';

        ClassicEditor
            .create(document.querySelector('#deskripsi'), {
                plugins: [Essentials, Bold, Italic, Font, Paragraph, Alignment, Underline, List],
                toolbar: [
                    'undo', 'redo', '|', 'bold', 'italic', 'underline', '|',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', '|', 'alignment', '|',
                    'bulletedList', 'numberedList'
                ]
            })
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

    <script>
        // Get the form element
        const form = document.querySelector('#create-form');
        const submitButton = form.querySelector('button[type="submit"]');
        const originalButtonText = submitButton.innerHTML;

        // Function to set loading state
        const setLoading = (isLoading) => {
            if (isLoading) {
                submitButton.disabled = true;
                submitButton.innerHTML = `
                    <div class="flex items-center justify-center">
                        <svg class="w-5 h-5 mr-3 text-white animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Memproses...
                    </div>
                `;
                submitButton.classList.add('opacity-75', 'cursor-not-allowed');
            } else {
                submitButton.disabled = false;
                submitButton.innerHTML = originalButtonText;
                submitButton.classList.remove('opacity-75', 'cursor-not-allowed');
            }
        };

        // Add submit event listener to the form
        form.addEventListener('submit', function(e) {
            // Show loading state
            setLoading(true);

            // The form will proceed with its normal submission
            // If you're using AJAX submission, you would handle it here

            // If using regular form submission, the loading state will remain
            // until the page refreshes with the server response
        });

        // This is useful if you're doing client-side validation
        form.addEventListener('invalid', function(e) {
            setLoading(false);
        }, true);
    </script>
@endpush
