<div class="relative w-full py-2 pl-20 pr-6 lg:px-12 lg:w-1/2 {{ $isRight ? 'lg:left-1/2': ''}}">
    <img src="{{ asset('img/timeline/bullet.svg') }}" alt=""
        class="absolute z-10 w-10 h-10 rounded-full img-bullet top-8 {{ $isRight ? '-left-5': '-right-5'}}">
    <div
        class="relative py-5 transition-all duration-500 rounded-lg bg-gradient-to-r from-sky-300 via-sky-200 to-sky-400 bg-size-200 bg-pos-0 hover:bg-pos-100 px-7">
        <div class="flex flex-col items-center justify-center gap-4 md:flex-row">
            <img src="{{ asset('img/icon/'. $img) }}" alt="map-icon" class="h-20">
            <div class="">
                <h2 class="mb-2 text-xl font-bold">{{ $judul }}</h2>
                <p>{{ $slot }}</p>
            </div>
        </div>
    </div>
</div>
