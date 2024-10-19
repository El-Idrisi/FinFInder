<div class="w-full bg-white rounded-lg shadow">
    <div
        class="text-white transition-all duration-300 rounded-t-lg cursor-pointer bg-sky-800 accordion hover:bg-sky-700">
        <h4 class="px-4 py-2 font-bold">{{ $title }}</h4>
    </div>
    <div class="overflow-hidden accor active">
        {{ $slot }}
    </div>
    <div class="py-4 border-t rounded-b-lg border-slate-300"></div>
</div>
