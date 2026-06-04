@extends('layouts.admin')

@section('title', 'View Blog')

@section('content')

<div class="bg-white p-6 rounded-2xl border">

    <h1 class="text-2xl font-bold mb-2">{{ $blog->title }}</h1>

    <p class="text-sm text-slate-500 mb-4">
        Category: {{ $blog->category->name ?? '-' }} |
        Status: {{ $blog->status }}
    </p>

    @if($blog->featured_image)
        <img src="{{ asset('storage/'.$blog->featured_image) }}"
             class="rounded-lg mb-4 w-full max-h-80 object-cover">
    @endif

    <div class="prose max-w-none">
        {!! $blog->content !!}
    </div>

</div>

@endsection