<div class="w-full rounded-lg shadow bg-white-100">
    <div
        class="text-white transition-all duration-300 rounded-t-lg
    {{ $isDelete ? 'bg-red-600' : 'bg-sky-800' }}
    {{ $isAccordion ? 'cursor-pointer accordion' : '' }}
    {{ $isAccordion && $isDelete ? 'hover:bg-red-700' : ($isAccordion ? 'hover:bg-sky-700' : '') }}">
        <h4 class="px-4 py-2 font-bold">{{ $title }}</h4>
    </div>
    <div class="overflow-hidden accor active">
        {{ $slot }}
    </div>
    @if ($allowFooter)
        <div class="py-4 border-t rounded-b-lg border-slate-300"></div>
    @endif
</div>
