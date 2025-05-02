@props(['id', 'previews' => [], 'deleteRoute'])

<div class="mt-6 space-y-4" id="{{ $id }}">
    @if ($previews)
        <div id="current-preview">
            <p>Current images</p>
            @foreach ($previews as $media)
                <div class="relative">
                    <img src="{{ $media->getUrl() }}" class="h-32 w-full rounded object-cover">
                    <form action="{{ route($deleteRoute, $media->id) }}" method="POST" class="absolute right-0 top-0">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="absolute right-0 top-0 mr-1 mt-1 rounded bg-red-500 px-2 py-1 text-sm text-white hover:underline">Remove</button>
                    </form>
                </div>
            @endforeach
        </div>
    @endif

    <div>
        <p>New images</p>
        <div id="preview-{{ $id }}"></div>
    </div>
</div>
