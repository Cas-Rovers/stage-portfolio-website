@props(['name', 'options' => [], 'selected' => [], 'id' => Str::uuid(), 'placeholder' => 'Select options'])

@php
    $selected = collect(old($name, $selected))->map(fn($val) => (string) $val)->toArray();
@endphp

<div x-data="{
    open: false,
    search: '',
    selected: {{ json_encode($selected) }},
    options: {{ json_encode($options) }},
    toggleOption(value) {
        if (this.selected.includes(value)) {
            this.selected = this.selected.filter(v => v !== value);
        } else {
            this.selected.push(value);
        }
    },
    isSelected(value) {
        return this.selected.includes(value);
    },
    filteredOptions() {
        return this.options.filter(opt => opt.label.toLowerCase().includes(this.search.toLowerCase()));
    }
}" class="relative">
    <div @click="open = !open" class="cursor-pointer rounded border bg-white p-2 dark:bg-gray-800">
        <template x-if="selected.length === 0">
            <span class="text-gray-400">{{ $placeholder }}</span>
        </template>
        <template x-for="value in selected" :key="value">
            <span class="mr-1 rounded bg-blue-600 px-2 py-1 text-xs text-white"
                x-text="options.find(opt => opt.value === value)?.label"></span>
        </template>
    </div>

    <div x-show="open" @click.away="open = false"
        class="absolute z-10 mt-1 w-full rounded border bg-white shadow dark:bg-gray-700">
        <input type="text" x-model="search" class="w-full border-b p-2 dark:bg-gray-800 dark:text-white"
            placeholder="Search..." />

        <div class="max-h-60 overflow-y-auto">
            <template x-for="opt in filteredOptions()" :key="opt.value">
                <div @click="toggleOption(opt.value)"
                    class="flex cursor-pointer items-center px-3 py-2 hover:bg-gray-100 dark:hover:bg-gray-600">
                    <input type="checkbox" :value="opt.value" class="mr-2" :checked="isSelected(opt.value)">
                    <span x-text="opt.label" class="text-sm"></span>
                </div>
            </template>
        </div>
    </div>

    <template x-for="val in selected">
        <input type="hidden" :name="'{{ $name }}[]'" :value="val">
    </template>
</div>
