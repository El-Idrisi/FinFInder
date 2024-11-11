<div class="flex flex-col items-center justify-center w-full gap-4 px-8 py-6 transition-all duration-500 shadow-md lg:w-1/2 rounded-xl bg-size-200 bg-pos-0 hover:bg-pos-100 hover:-translate-y-4 bg-gradient-to-l to-sky-300 via-sky-200 from-sky-400 md:flex-row hover:shadow-xl">
    <img src="{{ asset('img/icon/'. $img) }}" alt="map-icon" class="h-16" loading="lazy">
    <div class="">
        <h4 class="text-xl font-bold">{{ $judul }}</h4>
        <p>{{ $slot }}</p>
    </div>
</div>
