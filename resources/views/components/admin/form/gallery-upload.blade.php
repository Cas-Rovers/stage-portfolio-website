@props([
    'id' => $name,
    'name',
    'label',
    'accept' => 'image/jpg, image/jpeg, image/png, image/bmp, image/gif, image/webp, image/svg+xml',
])

<div class="flex flex-col gap-1">
    <x-admin.form.label :for="$id" :value="$label" />
    <div class="flex items-center">
        <label for="{{ $id }}"
            class="flex h-64 w-full cursor-pointer flex-col items-center justify-center rounded-lg border-2 border-dashed border-gray-300 bg-gray-50 hover:bg-gray-100">
            <svg class="mb-4 h-8 w-8 text-gray-500" fill="none" viewBox="0 0 20 16">
                <path stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
            </svg>
            <p class="text-sm text-gray-500">
                <span class="font-semibold">Click to upload</span>
                or drag and drop multiple images
            </p>
            <p class="text-xs text-gray-500">JPG, JPEG, PNG, BPM, GIF, WEBP (Max: 2MB each)</p>
        </label>
        <input id="{{ $id }}" type="file" name="{{ $name }}" accept="{{ $accept }}"
            class="hidden" multiple />
    </div>
    <x-admin.form.error :field="$name" />
</div>
