<div class="flex flex-col w-full">
    <label for="{{ $id }}" class="mb-2 font-bold">{{ $title }}</label>
    <input type="{{ $tipe }}" name="{{ $id }}" id="{{ $id }}"
        class="p-2 border-2 rounded-md outline-2 border-slate-400 focus:outline-sky-500"
        placeholder="{{ $title }}" autocomplete="off" value="{{ $value }}">
    @error($id)
        <p class="text-red-500">{{ $message }}</p>
    @enderror
</div>
