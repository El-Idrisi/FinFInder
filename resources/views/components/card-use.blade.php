<div
    class="flex flex-col items-center justify-center w-full p-8 transition-all duration-300 rounded-lg shadow-md md:w-1/3 bg-sky-50 hover:shadow-xl hover:-translate-y-4">
    {{ $icon }}
    <div class="mt-8 text-center">
        <h4 class="mb-4 text-xl font-bold">{{ $title }}</h4>
        <p>{{ $slot }}</p>
    </div>
</div>
