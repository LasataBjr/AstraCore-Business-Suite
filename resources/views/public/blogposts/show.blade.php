@extends('layouts.public')

@section('title', $blog->title)

@section('content')

<section class="bg-slate-900 text-white py-20">

    <div class="container mx-auto px-6">

        <div class="max-w-4xl mx-auto">

            <span class="inline-block px-3 py-1 rounded-full bg-indigo-600 text-sm">
                {{ $blog->category?->name }}
            </span>

            <h1 class="text-5xl font-bold mt-6 mb-6">
                {{ $blog->title }}
            </h1>

            <div class="text-slate-400 text-sm">
                By {{ $blog->author?->name }}
                •
                {{ optional($blog->published_at)->format('M d, Y') }}
            </div>

        </div>

    </div>

</section>

@if($blog->featured_image)

<section>
    <img
        src="{{ asset('storage/'.$blog->featured_image) }}"
        class="w-full max-h-[600px] object-cover"
        alt="{{ $blog->title }}"
    >
</section>

@endif

<section class="py-20">

    <div class="container mx-auto px-6">

        <div class="max-w-4xl mx-auto">

            <div class="prose prose-lg max-w-none">

                {!! $blog->content !!}

            </div>

            @if($blog->tags->count())

            <div class="mt-10 flex flex-wrap gap-2">

                @foreach($blog->tags as $tag)

                <span class="px-3 py-1 rounded-full bg-slate-100 text-sm">
                    #{{ $tag->name }}
                </span>

                @endforeach

            </div>

            @endif

        </div>

    </div>

</section>

@if($relatedPosts->count())

<section class="py-20 bg-slate-50">

    <div class="container mx-auto px-6">

        <h2 class="text-3xl font-bold mb-10">
            Related Posts
        </h2>

        <div class="grid md:grid-cols-3 gap-8">

            @foreach($relatedPosts as $post)

            <div class="bg-white rounded-2xl shadow-sm overflow-hidden">

                @if($post->featured_image)
                <img
                    src="{{ asset('storage/'.$post->featured_image) }}"
                    class="h-52 w-full object-cover"
                >
                @endif

                <div class="p-5">

                    <h3 class="font-bold mb-3">
                        {{ $post->title }}
                    </h3>

                    <a
                        href="{{ route('blogposts.show',$post->slug) }}"
                        class="text-indigo-600"
                    >
                        Read More →
                    </a>

                </div>

            </div>

            @endforeach

        </div>

    </div>

</section>

@endif

@endsection