@extends('layouts.public')

@section('title', $service->title)

@section('content')

{{-- Hero --}}
<section class="bg-slate-900 py-24 text-white">

    <div class="container mx-auto px-6">

        <div class="max-w-4xl">

            <span class="inline-block px-4 py-2 rounded-full bg-indigo-500/20 text-indigo-300 text-sm mb-4">
                Service
            </span>

            <h1 class="text-5xl font-bold mb-5">
                {{ $service->title }}
            </h1>

            <p class="text-slate-300 text-lg">
                Professional solutions tailored for your business.
            </p>

        </div>

    </div>

</section>

{{-- Featured Image --}}
@if($service->image)

<section>
    <img
        src="{{ asset('storage/'.$service->image) }}"
        class="w-full max-h-[550px] object-cover"
        alt="{{ $service->title }}"
    >
</section>

@endif

{{-- Service Content --}}
<section class="py-20">

    <div class="container mx-auto px-6">

        <div class="max-w-4xl mx-auto">

            <div class="prose prose-lg max-w-none">

                {!! $service->description !!}

            </div>

        </div>

    </div>

</section>

{{-- Related Services --}}
@if($relatedServices->count())

<section class="py-20 bg-slate-50">

    <div class="container mx-auto px-6">

        <div class="flex items-center justify-between mb-10">

            <h2 class="text-3xl font-bold">
                Related Services
            </h2>

            <a
                href="{{ route('services.index') }}"
                class="text-indigo-600 font-medium"
            >
                View All
            </a>

        </div>

        <div class="grid md:grid-cols-3 gap-8">

            @foreach($relatedServices as $item)

            <div class="bg-white rounded-2xl overflow-hidden shadow-sm">

                @if($item->image)
                    <img
                        src="{{ asset('storage/'.$item->image) }}"
                        class="w-full h-52 object-cover"
                        alt=""
                    >
                @endif

                <div class="p-5">

                    <h3 class="font-bold text-lg mb-3">
                        {{ $item->title }}
                    </h3>

                    <p class="text-slate-600 text-sm mb-4">
                        {{ Str::limit(strip_tags($item->description), 80) }}
                    </p>

                    <a
                        href="{{ route('services.show',$item->slug) }}"
                        class="text-indigo-600 font-medium"
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

{{-- CTA --}}
<section class="bg-indigo-600 py-20 text-white">

    <div class="container mx-auto px-6 text-center">

        <h2 class="text-4xl font-bold mb-4">
            Need This Service?
        </h2>

        <p class="mb-8 text-indigo-100">
            Let's discuss your project and create something amazing together.
        </p>

        <a
            href="{{ route('contact') }}"
            class="inline-flex px-8 py-3 rounded-xl bg-white text-indigo-600 font-semibold"
        >
            Get a Free Consultation
        </a>

    </div>

</section>

@endsection