@extends('layouts.admin')

@section('title', 'Service Details')

@section('content')

<div class="bg-white p-6 rounded-xl border">

    <h2 class="text-2xl font-bold mb-2">{{ $service->title }}</h2>

    <p class="text-gray-600 mb-4">
        {{ $service->short_description }}
    </p>

    @if($service->featured_image)
        <img src="{{ Storage::url($service->featured_image) }}"
             class="w-full max-h-96 object-cover rounded mb-4">
    @endif

    <div class="prose max-w-none">
        {!! nl2br(e($service->description)) !!}
    </div>

</div>

@endsection