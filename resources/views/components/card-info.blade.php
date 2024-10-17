<div class="w-full p-4 transition-all duration-300 bg-white rounded-md shadow-md lg:w-1/4 hover:-translate-y-4 hover:shadow-xl">
    <h4 class="font-semibold text-slate-400">{{ $judul }}</h4>
    <div class="flex justify-between mt-4 text-2xl font-semibold">
        <h4 class="">0 Data</h4>
        <span class="{{ $isCheck ? 'px-3 py-1' : 'px-4 py-2'}} rounded bg-{{ $warna }}-200 ">{{ $slot }}</span>
    </div>
</div>
