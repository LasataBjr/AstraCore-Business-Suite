@extends('layouts.public')

@section('title', 'Projects')

@section('content')

<section class="py-20 bg-slate-50">
    <div class="container mx-auto px-4">

        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold">
                Our Projects
            </h1>

            <p class="text-slate-600 mt-3">
                Explore our latest portfolio work.
            </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

            @forelse($projects as $project)

                <div class="bg-white rounded-2xl overflow-hidden shadow-sm border">

                    @if($project->featured_image)
                        <img
                            src="{{ asset('storage/'.$project->featured_image) }}"
                            class="w-full h-60 object-cover"
                        >
                    @endif

                    <div class="p-6">

                        @if($project->category)
                            <span class="text-indigo-600 text-sm">
                                {{ $project->category->name }}
                            </span>
                        @endif

                        <h3 class="text-xl font-semibold mt-2">
                            {{ $project->title }}
                        </h3>

                        <p class="text-slate-600 mt-3">
                            {{ Str::limit(strip_tags($project->description), 120) }}
                        </p>

                        <a
                            href="{{ route('projects.show', $project->slug) }}"
                            class="inline-block mt-4 text-indigo-600 font-medium"
                        >
                            View Project →
                        </a>

                    </div>
                </div>

            @empty

                <div class="col-span-full text-center py-12">
                    No projects available.
                </div>

            @endforelse

        </div>

        <div class="mt-10">
            {{ $projects->links() }}
        </div>

    </div>
</section>

@endsection