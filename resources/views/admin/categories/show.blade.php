@extends('layouts.admin')

@section('title', 'Category Details')

@section('content')

<div class="bg-white p-6 rounded-xl border">

    <h1 class="text-xl font-semibold mb-4">
        {{ $category->name }}
    </h1>

    <p class="text-slate-600 mb-2">
        <strong>Slug:</strong> {{ $category->slug }}
    </p>

    <p class="text-slate-600 mb-2">
        <strong>Status:</strong> {{ $category->status }}
    </p>

    <p class="text-slate-600">
        <strong>Description:</strong><br>
        {{ $category->description ?? 'No description' }}
    </p>

    <div class="mt-6">
        <a href="{{ route('admin.categories.edit', $category) }}"
           class="px-4 py-2 bg-indigo-600 text-white rounded-lg">
            Edit Category
        </a>
    </div>

</div>

@endsection