@props(['id' => $name, 'label', 'name', 'options', 'selected' => null, 'placeholder' => ''])

<div class="flex flex-col gap-1">
    <x-admin.form.label :for="$id" :value="$label" />
    <select id="{{ $id }}" name="{{ $name }}"
        class="mt-1 block w-full rounded border border-gray-300 p-2">
        <option value="" selected disabled>{{ $placeholder }}</option>
        @foreach ($options as $option)
            <option value="{{ $option }}" {{ in_array($option, (array) old($name, $selected)) ? 'selected' : '' }}>
                {{ $option }}
            </option>
        @endforeach
    </select>
    <x-admin.form.error :field="$name" />
</div>
