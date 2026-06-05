@extends('layouts.admin')

@section('title', 'Create Service')

@section('content')

<div class="bg-white p-6 rounded-xl border">

    <h2 class="text-lg font-semibold mb-4">Create Service</h2>

    <form method="POST"
          action="{{ route('admin.services.store') }}"
          enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <input type="text"
                   name="title"
                   placeholder="Service Title"
                   class="border p-2 rounded w-full">

            <select name="category_id" class="border p-2 rounded w-full">
                <option value="">Select Category</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>

            <input type="text"
                   name="icon"
                   placeholder="Icon class (optional)"
                   class="border p-2 rounded w-full">

            <select name="status" class="border p-2 rounded w-full">
                <option value="draft">Draft</option>
                <option value="published">Published</option>
                <option value="archived">Archived</option>
            </select>

            <input type="file"
                   name="featured_image"
                   class="border p-2 rounded w-full">

            <label class="flex items-center gap-2">
                <input type="checkbox" name="is_featured" value="1">
                Featured Service
            </label>

        </div>

        <textarea name="short_description"
                  placeholder="Short description"
                  class="border p-2 rounded w-full mt-4"></textarea>

        <textarea name="description"
                  rows="6"
                  placeholder="Full description"
                  class="border p-2 rounded w-full mt-3"></textarea>

        <button class="mt-4 bg-indigo-600 text-white px-4 py-2 rounded">
            Save Service
        </button>

    </form>

</div>

@endsection