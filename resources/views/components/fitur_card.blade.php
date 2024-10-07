<div class="flex flex-col items-center justify-center w-full gap-4 px-8 py-6 transition-all duration-500 lg:w-1/2 rounded-xl bg-size-200 bg-pos-0 hover:bg-pos-100 hover:scale-105 bg-gradient-to-l to-sky-300 via-sky-200 from-sky-400 md:flex-row">
    <img src="{{ asset('img/icon/'. $img) }}" alt="map-icon" class="h-16">
    <div class="">
        <h4 class="text-xl font-bold">{{ $judul }}</h4>
        <p>{{ $slot }}</p>
    </div>
</div>
