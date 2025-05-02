@props(['id' => $name, 'label', 'name', 'value' => '', 'type' => 'text', 'required' => false])

<div class="flex flex-col gap-1">
    <x-admin.form.label :for="$id" :value="$label" />
    <input id="{{ $id }}" name="{{ $name }}" type="{{ $type }}" value="{{ old($name, $value) }}"
        class="mt-1 block w-full rounded border border-gray-300 p-2" @if ($required) required @endif />
    <x-admin.form.error :field="$name" />
</div>
