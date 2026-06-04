@extends('layouts.admin')

@section('title', 'Create Blog')

@section('content')

<div class="bg-white p-6 rounded-2xl border">

    <h2 class="text-lg font-semibold mb-4">Create Blog Post</h2>

    <form method="POST" action="{{ route('admin.blogs.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <input type="text" name="title" placeholder="Title"
                   class="border p-2 rounded w-full">

            <select name="category_id" class="border p-2 rounded w-full">
                <option>Select Category</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>

            <select name="status" class="border p-2 rounded w-full">
                <option value="draft">Draft</option>
                <option value="published">Published</option>
            </select>

            <input type="file" name="featured_image"
                   class="border p-2 rounded w-full">

        </div>

        <textarea name="content" rows="6"
                  class="border p-2 rounded w-full mt-4"
                  placeholder="Write content..."></textarea>

        <button class="mt-4 bg-indigo-600 text-white px-4 py-2 rounded">
            Save Post
        </button>

    </form>

</div>

@endsection