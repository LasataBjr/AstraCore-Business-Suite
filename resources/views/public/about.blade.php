@extends('layouts.public')

@section('title', 'About Us')

@section('content')

{{-- HERO --}}
<section class="bg-slate-900 text-white py-24">
    <div class="container mx-auto px-6 text-center">
        <span class="inline-block px-4 py-2 rounded-full bg-indigo-500/20 text-indigo-300 text-sm mb-4">
            About AstraCore
        </span>

        <h1 class="text-5xl font-bold mb-6">
            Building Modern Digital Experiences
        </h1>

        <p class="max-w-3xl mx-auto text-slate-300 text-lg">
            We help businesses grow through web development, UI/UX design,
            branding, digital marketing, and technology solutions.
        </p>
    </div>
</section>

{{-- ABOUT COMPANY --}}
<section class="py-20 bg-white">
    <div class="container mx-auto px-6">

        <div class="grid lg:grid-cols-2 gap-12 items-center">

            <div>
                <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f"
                     class="rounded-3xl shadow-lg"
                     alt="">
            </div>

            <div>
                <span class="text-indigo-600 font-semibold">
                    Who We Are
                </span>

                <h2 class="text-4xl font-bold mt-3 mb-6">
                    A Creative & Technology Driven Agency
                </h2>

                <p class="text-slate-600 mb-5">
                    AstraCore is a modern digital agency focused on delivering
                    innovative websites, scalable applications, and impactful
                    digital experiences for businesses of all sizes.
                </p>

                <p class="text-slate-600">
                    Our mission is to transform ideas into powerful digital
                    solutions that help brands establish authority, improve
                    customer engagement, and achieve long-term growth.
                </p>
            </div>

        </div>

    </div>
</section>

{{-- MISSION VISION --}}
<section class="py-20 bg-slate-50">
    <div class="container mx-auto px-6">

        <div class="grid md:grid-cols-2 gap-8">

            <div class="bg-white p-8 rounded-3xl shadow-sm">
                <h3 class="text-2xl font-bold mb-4">
                    Our Mission
                </h3>

                <p class="text-slate-600">
                    To empower businesses with innovative digital solutions,
                    helping them grow through technology, creativity,
                    and strategic thinking.
                </p>
            </div>

            <div class="bg-white p-8 rounded-3xl shadow-sm">
                <h3 class="text-2xl font-bold mb-4">
                    Our Vision
                </h3>

                <p class="text-slate-600">
                    To become a trusted global technology partner known for
                    quality, innovation, and client success.
                </p>
            </div>

        </div>

    </div>
</section>

{{-- STATS --}}
<section class="py-20 bg-white">
    <div class="container mx-auto px-6">

        <div class="grid md:grid-cols-4 gap-6 text-center">

            <div>
                <h3 class="text-5xl font-bold text-indigo-600">50+</h3>
                <p class="text-slate-600 mt-2">Projects Delivered</p>
            </div>

            <div>
                <h3 class="text-5xl font-bold text-indigo-600">25+</h3>
                <p class="text-slate-600 mt-2">Happy Clients</p>
            </div>

            <div>
                <h3 class="text-5xl font-bold text-indigo-600">5+</h3>
                <p class="text-slate-600 mt-2">Years Experience</p>
            </div>

            <div>
                <h3 class="text-5xl font-bold text-indigo-600">100%</h3>
                <p class="text-slate-600 mt-2">Client Satisfaction</p>
            </div>

        </div>

    </div>
</section>

{{-- TEAM --}}
<section class="py-20 bg-slate-50">
    <div class="container mx-auto px-6">

        <div class="text-center mb-14">
            <h2 class="text-4xl font-bold">
                Meet Our Team
            </h2>

            <p class="text-slate-500 mt-4">
                The people behind our success.
            </p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">

            @foreach($teamMembers as $member)

                <div class="bg-white rounded-3xl shadow-sm overflow-hidden">

                    <img src="{{ asset('storage/'.$member->image) }}"
                         class="h-72 w-full object-cover">

                    <div class="p-5">

                        <h3 class="font-bold text-lg">
                            {{ $member->name }}
                        </h3>

                        <p class="text-indigo-600 text-sm">
                            {{ $member->designation }}
                        </p>

                        <p class="text-slate-500 text-sm mt-3">
                            {{ Str::limit($member->bio, 100) }}
                        </p>

                    </div>

                </div>

            @endforeach

        </div>

    </div>
</section>

{{-- CTA --}}
<section class="py-20 bg-indigo-600 text-white">
    <div class="container mx-auto px-6 text-center">

        <h2 class="text-4xl font-bold mb-4">
            Let's Build Something Amazing Together
        </h2>

        <p class="text-indigo-100 mb-8">
            Have a project in mind? We'd love to hear about it.
        </p>

        <a href="{{ route('contact') }}"
           class="inline-block bg-white text-indigo-600 px-8 py-3 rounded-xl font-semibold">
            Contact Us
        </a>

    </div>
</section>

@endsection