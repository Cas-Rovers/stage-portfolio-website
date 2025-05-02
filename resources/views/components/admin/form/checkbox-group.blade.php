@props(['label', 'name', 'options' => [], 'selected' => []])

@php
    $selected = collect($selected)->map(fn($val) => (string) $val)->toArray();
@endphp

<div class="flex flex-col gap-1">
    <span class="block text-sm font-medium text-gray-700">{{ $label }}</span>
    <div class="flex flex-wrap gap-3">
        @foreach ($options as $key => $option)
            @php
                $id = is_object($option) ? $option->id : $key;
                $label = is_object($option) ? $option->name : $option;
            @endphp
            <label class="flex items-center space-x-2 text-sm text-gray-700">
                <input type="checkbox" name="{{ $name }}[]" value="{{ $id }}"
                    @checked(in_array((string) $id, $selected))
                    class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" />
                <span>{{ $label }}</span>
            </label>
        @endforeach
    </div>
    <x-admin.form.error :field="$name" />
</div>
