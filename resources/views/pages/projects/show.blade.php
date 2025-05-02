@extends('layouts.guest')

@section('title', $project->title)

@section('content')
    <div
        class="container mx-auto max-w-4xl rounded-lg border border-slate-100 bg-white p-6 shadow-lg dark:border-0 dark:bg-gray-800">
        <div class="mb-4">
            <a href="{{ route('projects.index') }}"
                class="inline-flex items-center font-semibold text-blue-500 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300">
                <i class="fa-solid fa-arrow-left mr-2"></i>
                {{ __('projects.show.go-back') }}
            </a>
        </div>

        <div class="mb-6">
            <h1 class="text-4xl font-extrabold text-gray-900 dark:text-white">{{ $project->title }}</h1>
        </div>

        @if ($project->hasMedia('main_image'))
            <div class="mb-6">
                <img src="{{ $project->getFirstMediaUrl('main_image', 'original') }}" alt="{{ $project->title }}"
                    class="h-auto w-full rounded-lg shadow-md">
            </div>
        @endif

        <div class="tinymce-content">
            {!! $project->description !!}
        </div>

        <div class="mb-6">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">{{ __('projects.category') }}:</h3>
            <p
                class="w-fit rounded-full bg-indigo-100 p-0 px-3 py-1 text-xs font-medium text-indigo-800 dark:bg-indigo-600 dark:text-indigo-200">
                {{ $project->category }}
            </p>
        </div>

        <div class="mb-6">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">{{ __('projects.tags.title') }}:</h3>
            <ul class="mt-3 flex flex-wrap gap-2">
                <span>{{ __('projects.tags.title') }}:</span>
                @foreach ($project->tags as $tag)
                    <li
                        class="rounded-full bg-indigo-100 px-3 py-1 text-xs font-medium text-indigo-800 dark:bg-indigo-600 dark:text-indigo-200">
                        {{ $tag->name }}
                    </li>
                @endforeach
            </ul>
        </div>

        @if ($project->hasMedia('gallery'))
            <div class="mb-6">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">{{ __('projects.gallery') }}:</h3>
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($project->getMedia('gallery') as $media)
                        <div>
                            <img src="{{ $media->getUrl('preview') }}" alt="Gallery Image"
                                class="h-auto w-full rounded-lg shadow-md">
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="mb-6">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">{{ __('projects.status') }}:</h3>
            <p class="text-lg text-gray-700 dark:text-gray-300">
                @if ($project->is_published)
                    {{ __('projects.published-on') }} {{ $project->published_at->format('F j, Y') }}
                @else
                    {{ __('projects.draft') }}
                @endif
            </p>
        </div>

        <div class="mb-6">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">{{ __('projects.created-at') }}:</h3>
            <p class="text-lg text-gray-700 dark:text-gray-300">{{ $project->created_at->format('F j, Y') }}</p>
        </div>
    </div>
@endsection
