@extends('layouts.app')

@section('title', __('projects.admin.create.title'))

@section('content')
    <div class="mx-auto max-w-4xl rounded-lg bg-white p-6 shadow-md">
        <h2 class="mb-6 text-3xl font-bold text-gray-800">Create Project</h2>

        @if (session()->has('message'))
            <div class="mb-4 rounded-md bg-green-100 px-4 py-2 text-green-800">
                {{ session('message') }}
            </div>
        @endif

        <form action="{{ route('admin.projects.create') }}" method="POST" enctype="multipart/form-data"
            class="flex flex-col gap-3">
            @csrf

            <x-admin.form.input label="{{ __('projects.admin.title') }}" name="title" :value="old('title')" required />

            <x-admin.form.editor label="{{ __('projects.admin.description') }}" name="description" />

            <x-admin.form.select label="{{ __('projects.admin.categories') }}" name="category" :options="$projectCategories"
                placeholder="{{ __('projects.categories.options.all') }}" />

            <x-admin.form.checkbox-group label="{{ __('projects.admin.tags') }}" name="tags" :options="$projectTags" />

            <x-admin.form.toggle label="{{ __('projects.admin.is-published') }}" name="is_published" />

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <x-admin.form.image-upload label="{{ __('projects.admin.main-image') }}" name="main_image" />
                <x-admin.form.gallery-upload id="gallery" label="{{ __('projects.admin.gallery') }}" name="gallery[]" />
            </div>

            <div class="mt-8 flex justify-between">
                <a href="{{ route('admin.projects.index') }}"
                    class="text-blue-500 hover:underline">{{ __('projects.admin.back-to-projects') }}</a>
                <button type="submit" class="rounded bg-blue-600 px-6 py-2 font-semibold text-white hover:bg-blue-700">
                    {{ __('projects.admin.save') }}
                </button>
            </div>
        </form>

        <!-- Preview Container -->
        <div class="grid grid-cols-2">
            <div class="p-2">
                <x-admin.form.image-previews id="main_image" />
            </div>
            <div class="p-2">
                <x-admin.form.image-previews id="gallery" />
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @vite(['resources/assets/admin/js/components/image-previews.js'])
@endpush
