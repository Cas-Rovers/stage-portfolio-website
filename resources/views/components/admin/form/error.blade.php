@props(['field'])

@if ($errors->has($field))
    <span class="text-sm text-red-500">{{ $errors->first($field) }}</span>
@endif
