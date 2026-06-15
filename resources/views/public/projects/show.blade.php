@extends('layouts.public')

@section('title', $project->title)

@section('content')

<section class="py-20">

    <div class="container mx-auto px-4">

        {{-- Header --}}
        <div class="max-w-4xl mx-auto text-center mb-12">

            @if($project->category)
                <span class="text-indigo-600">
                    {{ $project->category->name }}
                </span>
            @endif

            <h1 class="text-5xl font-bold mt-3">
                {{ $project->title }}
            </h1>

            @if($project->client_name)
                <p class="text-slate-500 mt-4">
                    Client: {{ $project->client_name }}
                </p>
            @endif

        </div>

        {{-- Featured Image --}}
        @if($project->featured_image)

            <div class="mb-12">

                <img
                    src="{{ asset('storage/'.$project->featured_image) }}"
                    class="w-full rounded-3xl shadow-lg"
                >

            </div>

        @endif

        {{-- Description --}}
        <div class="max-w-4xl mx-auto prose prose-lg">

            {!! $project->description !!}

        </div>

        {{-- Project URL --}}
        @if($project->project_url)

            <div class="text-center mt-10">

                <a
                    href="{{ $project->project_url }}"
                    target="_blank"
                    class="bg-indigo-600 text-white px-6 py-3 rounded-xl"
                >
                    Visit Project
                </a>

            </div>

        @endif

    </div>

</section>

{{-- Gallery --}}
@if($project->images->count())

<section class="py-16 bg-slate-50">

    <div class="container mx-auto px-4">

        <h2 class="text-3xl font-bold text-center mb-10">
            Project Gallery
        </h2>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">

            @foreach($project->images as $image)

                <img
                    src="{{ asset('storage/'.$image->image) }}"
                    class="rounded-2xl shadow-md w-full h-72 object-cover"
                >

            @endforeach

        </div>

    </div>

</section>

@endif

{{-- Related Projects --}}
@if($relatedProjects->count())

<section class="py-20">

    <div class="container mx-auto px-4">

        <h2 class="text-3xl font-bold mb-10">
            Related Projects
        </h2>

        <div class="grid md:grid-cols-3 gap-8">

            @foreach($relatedProjects as $item)

                <div class="bg-white border rounded-2xl overflow-hidden">

                    @if($item->featured_image)

                        <img
                            src="{{ asset('storage/'.$item->featured_image) }}"
                            class="h-56 w-full object-cover"
                        >

                    @endif

                    <div class="p-5">

                        <h3 class="font-semibold text-lg">
                            {{ $item->title }}
                        </h3>

                        <a
                            href="{{ route('projects.show', $item->slug) }}"
                            class="text-indigo-600 mt-3 inline-block"
                        >
                            View Project →
                        </a>

                    </div>

                </div>

            @endforeach

        </div>

    </div>

</section>

@endif

@endsection