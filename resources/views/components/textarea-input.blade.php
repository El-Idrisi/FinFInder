<div class="flex flex-col w-full">
    <label for="{{ $id }}" class="mb-2 font-bold {{ $attributes }}">{{ $title }}</label>
    <textarea name="{{ $id }}" id="{{ $id }}" placeholder="{{ $title }}" rows="3"
        class="p-2 border-2 rounded-md resize-none outline-2 border-slate-400 focus:outline-sky-500">{{ $slot }}</textarea>
    @error('{{ $id }}')
        <p class="text-red-500">{{ $message }}</p>
    @enderror
</div>
