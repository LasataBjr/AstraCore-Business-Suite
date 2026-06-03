@extends('layouts.admin') 

@section('title', 'Dashboard')

@section('content')
    <div>
        <h1 class="text-2xl font-bold mb-6 text-gray-800">Dashboard</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-gray-500">Services</h3>
                <p class="text-3xl font-bold">
                    {{ $stats['services'] }}
                </p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-gray-500">Projects</h3>
                <p class="text-3xl font-bold">
                    {{ $stats['projects'] }}
                </p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-gray-500">Blog Posts</h3>
                <p class="text-3xl font-bold">
                    {{ $stats['blogPosts'] }}
                </p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-gray-500">Messages</h3>
                <p class="text-3xl font-bold">
                    {{ $stats['messages'] }}
                </p>
            </div>

        </div>
    </div>
@endsection