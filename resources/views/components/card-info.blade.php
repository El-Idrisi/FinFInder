<div class="w-full p-4 transition-all duration-300 bg-white rounded-md shadow-md lg:w-1/4 hover:-translate-y-4 hover:shadow-xl">
    <h4 class="font-semibold text-slate-400">{{ $judul }}</h4>
    <div class="flex justify-between mt-4 text-xl font-semibold lg:text-2xl">
        <h4 class="">{{ $slot }}</h4>
        <span class="{{ $isCheck ? 'px-3 py-1' : 'px-4 py-2'}} rounded {{ $warna == 'sky' ? 'bg-sky-200' : '' }} {{ $warna == 'green' ? 'bg-green-200' : ''}} {{ $warna == 'fuchsia' ? 'bg-fuchsia-200' : '' }} {{ $warna == 'red' ? 'bg-red-200' : '' }}"><i class="{{ $warna == 'sky' ? 'text-sky-500' : '' }} {{ $warna == 'green' ? 'text-green-500' : ''}} {{ $warna == 'fuchsia' ? 'text-fuchsia-500' : '' }} {{ $warna == 'red' ? 'text-red-500' : '' }} fa-solid fa-{{ $icon }}"></i></span>
    </div>
</div>
