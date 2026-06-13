@extends('layouts.public')

@section('title', 'Blog')

@section('content')

<section class="bg-slate-900 py-24 text-white">
    <div class="container mx-auto px-6 text-center">
        <h1 class="text-5xl font-bold mb-4">
            Our Blog
        </h1>

        <p class="text-slate-300">
            Insights, tutorials and industry updates.
        </p>
    </div>
</section>

<section class="py-20">
    <div class="container mx-auto px-6">

        <div class="grid lg:grid-cols-3 gap-8">

            @foreach($blogs as $blog)

            <article class="bg-white rounded-3xl shadow-sm overflow-hidden">

                @if($blog->featured_image)
                <img
                    src="{{ asset('storage/'.$blog->featured_image) }}"
                    class="w-full h-60 object-cover"
                    alt="{{ $blog->title }}"
                >
                @endif

                <div class="p-6">

                    <span class="text-indigo-600 text-sm font-medium">
                        {{ $blog->category?->name }}
                    </span>

                    <h2 class="text-xl font-bold mt-3 mb-3">
                        {{ $blog->title }}
                    </h2>

                    <p class="text-slate-600 mb-4">
                        {{ $blog->excerpt }}
                    </p>

                    <a
                        href="{{ route('blogposts.show',$blog->slug) }}"
                        class="text-indigo-600 font-semibold"
                    >
                        Read More →
                    </a>

                </div>

            </article>

            @endforeach

        </div>

        <div class="mt-10">
            {{ $blogs->links() }}
        </div>

    </div>
</section>

@endsection