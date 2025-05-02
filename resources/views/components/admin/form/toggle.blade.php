@props(['name', 'label', 'checked' => false, 'id' => Str::uuid()])

@php
    $checked = old($name, $checked) ? 'true' : 'false';
@endphp

<div x-data="{ on: {{ $checked }} }" class="flex items-center space-x-2">
    <x-admin.form.label :for="$id" :value="$label" />
    <div @click="on = !on" :class="on ? 'bg-blue-600' : 'bg-gray-300'"
        class="relative flex h-6 w-11 cursor-pointer items-center rounded-full transition duration-300">
        <span :class="on ? 'translate-x-6' : 'translate-x-1'"
            class="inline-block h-4 w-4 transform rounded-full bg-white shadow transition"></span>
    </div>
    <input id="{{ $id }}" type="hidden" name="{{ $name }}" :value="on ? 1 : 0">

    <x-admin.form.error :field="$name" />
</div>
