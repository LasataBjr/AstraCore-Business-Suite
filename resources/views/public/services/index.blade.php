@extends('layouts.public')

@section('title', 'Our Services')

@section('content')

{{-- Hero --}}
<section class="bg-slate-900 py-24 text-white">
    <div class="container mx-auto px-6 text-center">

        <span class="inline-block px-4 py-2 rounded-full bg-indigo-500/20 text-indigo-300 text-sm mb-4">
            What We Offer
        </span>

        <h1 class="text-5xl font-bold mb-4">
            Our Services
        </h1>

        <p class="max-w-2xl mx-auto text-slate-300">
            We provide innovative digital solutions designed
            to help businesses grow and succeed online.
        </p>

    </div>
</section>

{{-- Services Grid --}}
<section class="py-20">
    <div class="container mx-auto px-6">

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

            @forelse($services as $service)

            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden hover:shadow-lg transition">

                @if($service->image)
                    <img
                        src="{{ asset('storage/'.$service->image) }}"
                        class="w-full h-56 object-cover"
                        alt="{{ $service->title }}"
                    >
                @endif

                <div class="p-6">

                    <h3 class="text-xl font-bold text-slate-900 mb-3">
                        {{ $service->title }}
                    </h3>

                    <p class="text-slate-600 mb-5">
                        {{ Str::limit(strip_tags($service->description), 120) }}
                    </p>

                    <a
                        href="{{ route('services.show',$service->slug) }}"
                        class="inline-flex items-center gap-2 text-indigo-600 font-semibold"
                    >
                        Learn More →
                    </a>

                </div>

            </div>

            @empty

            <div class="col-span-3 text-center py-10">
                No services found.
            </div>

            @endforelse

        </div>

        <div class="mt-10">
            {{ $services->links() }}
        </div>

    </div>
</section>

@endsection