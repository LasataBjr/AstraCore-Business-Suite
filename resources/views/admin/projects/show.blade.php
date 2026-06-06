@extends('layouts.admin')
 
@section('title', $project->title)
@section('page-title', 'Projects')
 
@section('breadcrumb')
    <span class="text-slate-300">/</span>
    <a href="{{ route('admin.projects.index') }}" class="hover:text-indigo-600 transition-colors">All Projects</a>
    <span class="text-slate-300">/</span>
    <span class="text-slate-500 truncate max-w-[180px]">{{ Str::limit($project->title, 35) }}</span>
@endsection
 
@section('content')
<div class="p-6">

    <h1 class="text-2xl font-bold mb-2">{{ $project->title }}</h1>

    <p class="text-gray-600 mb-4">
        Client: {{ $project->client_name ?? '-' }}
    </p>

    {{-- Featured Image --}}
    @if($project->featured_image)
        <img src="{{ asset('storage/' . $project->featured_image) }}"
             class="w-64 rounded mb-4">
    @endif

    {{-- Description --}}
    <div class="prose max-w-none">
        {!! $project->description !!}
    </div>

    {{-- Gallery --}}
    <div class="grid grid-cols-3 gap-3 mt-6">
        @foreach($project->images as $img)
            <img src="{{ asset('storage/' . $img->image) }}"
                 class="rounded">
        @endforeach
    </div>

</div>
@endsection