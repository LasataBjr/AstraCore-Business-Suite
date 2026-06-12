@extends('layouts.public')

@section('title', 'Contact Us')

@section('content')

<section class="py-20 bg-slate-50">
    <div class="max-w-6xl mx-auto px-6">

        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-slate-900">
                Contact Us
            </h1>

            <p class="mt-3 text-slate-500">
                Let's discuss your next project.
            </p>
        </div>

        @if(session('success'))
            <div class="mb-6 rounded-xl bg-green-100 p-4 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid lg:grid-cols-2 gap-10">

            {{-- Contact Info --}}
            <div>
                <h2 class="text-2xl font-semibold mb-4">
                    Get In Touch
                </h2>

                <div class="space-y-4">

                    <div class="p-4 bg-white rounded-xl shadow-sm border">
                        <h3 class="font-medium">Email</h3>
                        <p class="text-slate-500">
                            asassha03@gmail.com
                        </p>
                    </div>

                    <div class="p-4 bg-white rounded-xl shadow-sm border">
                        <h3 class="font-medium">Phone</h3>
                        <p class="text-slate-500">
                            +977-9800000000
                        </p>
                    </div>

                    <div class="p-4 bg-white rounded-xl shadow-sm border">
                        <h3 class="font-medium">Location</h3>
                        <p class="text-slate-500">
                            Kathmandu, Nepal
                        </p>
                    </div>

                </div>
            </div>

            {{-- Contact Form --}}
            <div class="bg-white p-8 rounded-2xl shadow-sm border">

                <form action="{{ route('contact.store') }}"
                      method="POST">

                    @csrf

                    <div class="grid md:grid-cols-2 gap-4">

                        <div>
                            <label class="block mb-2 text-sm font-medium">
                                Name
                            </label>

                            <input type="text"
                                   name="name"
                                   value="{{ old('name') }}"
                                   class="w-full border rounded-xl px-4 py-3">
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-medium">
                                Email
                            </label>

                            <input type="email"
                                   name="email"
                                   value="{{ old('email') }}"
                                   class="w-full border rounded-xl px-4 py-3">
                        </div>

                    </div>

                    <div class="mt-4">
                        <label class="block mb-2 text-sm font-medium">
                            Phone
                        </label>

                        <input type="text"
                               name="phone"
                               value="{{ old('phone') }}"
                               class="w-full border rounded-xl px-4 py-3">
                    </div>

                    <div class="mt-4">
                        <label class="block mb-2 text-sm font-medium">
                            Subject
                        </label>

                        <input type="text"
                               name="subject"
                               value="{{ old('subject') }}"
                               class="w-full border rounded-xl px-4 py-3">
                    </div>

                    <div class="mt-4">
                        <label class="block mb-2 text-sm font-medium">
                            Message
                        </label>

                        <textarea name="message"
                                  rows="6"
                                  class="w-full border rounded-xl px-4 py-3">{{ old('message') }}</textarea>
                    </div>

                    <button type="submit"
                            class="mt-6 w-full bg-indigo-600 text-white py-3 rounded-xl hover:bg-indigo-700 transition">
                        Send Message
                    </button>

                </form>

            </div>

        </div>

    </div>
</section>

@endsection