@extends('layouts.guest')

@section('title', __('projects.title'))

@section('content')
    <section class="bg-transparent">
        <div class="container mx-auto px-6 md:px-12 lg:px-20">
            @livewire('projects-view')
        </div>
    </section>
@endsection
