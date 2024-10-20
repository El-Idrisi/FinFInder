<div class="flex flex-col w-full">
    <label for="alamat" class="mb-2 font-bold">Alamat</label>
    <textarea name="alamat" id="alamat" placeholder="Alamat" rows="3"
        class="p-2 border-2 rounded-md resize-none outline-2 border-slate-400 focus:outline-sky-500">{{ $slot }}</textarea>
    @error('alamat')
        <p class="text-red-500">{{ $message }}</p>
    @enderror
</div>
