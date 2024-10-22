<div {{ $attributes->merge(['class' => 'w-full bg-white rounded-lg shadow']) }}>
    <div
        class="text-white transition-all duration-300 rounded-t-lg cursor-pointer accordion {{ $isDelete ? 'bg-red-600 hover:bg-red-500' : 'bg-sky-800 hover:bg-sky-700' }}">
        <h4 class="px-4 py-2 font-bold">{{ $title }}</h4>
    </div>
    <div class="overflow-hidden accor active">
        {{ $slot }}
    </div>
    <div class="py-4 border-t rounded-b-lg border-slate-300"></div>
</div>
