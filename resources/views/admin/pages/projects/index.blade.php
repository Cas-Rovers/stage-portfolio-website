@extends('layouts.app')

@section('title', __('projects.admin.index.title'))

@section('content')
    <livewire:admin.data-table :model="$projectClass" :columns="['id', 'title', 'slug', 'is_published', 'published_at']" createLink="admin.projects.create"
        editLink="admin.projects.edit" deleteLink="admin.projects.destroy" />
@endsection
