@props(['id' => 'editor', 'label', 'name', 'content' => ''])

<div class="flex flex-col gap-1">
    <x-admin.form.label :for="$id" :value="$label" />
    <textarea id="{{ $id }}" name="{{ $name }}" class="tinymce-editor hidden">{!! $content !!}</textarea>
    <x-admin.form.error :field="$name" />
</div>
