<div class="flex flex-col w-full">
    <label for="{{ $id }}" class="mb-2 font-bold">{{ $title }}</label>
    <div class="input-group">
        <div
            class="flex items-center border-2 rounded-md pass outline-2 border-slate-400 focus:outline-sky-500">
            <input type="password" name="{{ $id }}" id="{{ $id }}" placeholder="{{ $title }}"
                class="w-full p-2 bg-transparent rounded-full focus:outline-none ">
            <button type="button" href="#" class="flex items-center"
                onclick="showPassword('{{ $id }}')">
                <i id="eye-icon-{{ $id }}" class="pr-4 fa-solid fa-eye-slash text-sky-900"></i>
            </button>
        </div>
    </div>
    @error('{{ $id }}')
        <p class="text-red-500">{{ $message }}</p>
    @enderror
</div>
