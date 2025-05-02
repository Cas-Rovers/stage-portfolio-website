@extends('layouts.guest')

@section('meta')
    <meta name="description" content="{{ __('projects.meta.description') }}">
    <meta name="keywords" content="{{ __('projects.meta.keywords') }}">
    <meta name="author" content="{{ __('projects.meta.author') }}">
    <meta name="robots" content="index, follow">
@endsection

@section('title', __('projects.title'))

@section('content')
    <section class="bg-transparent">
        <div class="container mx-auto px-6 md:px-12 lg:px-20">
            @livewire('projects-view')
        </div>
    </section>
@endsection
