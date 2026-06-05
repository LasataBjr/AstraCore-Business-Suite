@extends('layouts.admin')

@section('title', 'Edit Service')

@section('content')

<div class="bg-white p-6 rounded-xl border">

    <h2 class="text-lg font-semibold mb-4">Edit Service</h2>

    <form method="POST"
          action="{{ route('admin.services.update', $service) }}"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <input type="text"
                   name="title"
                   value="{{ $service->title }}"
                   class="border p-2 rounded w-full">

            <select name="category_id" class="border p-2 rounded w-full">
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}"
                        {{ $service->category_id == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>

            <input type="text"
                   name="icon"
                   value="{{ $service->icon }}"
                   class="border p-2 rounded w-full">

            <select name="status" class="border p-2 rounded w-full">
                <option value="draft" {{ $service->status=='draft'?'selected':'' }}>Draft</option>
                <option value="published" {{ $service->status=='published'?'selected':'' }}>Published</option>
            </select>

            <input type="file"
                   name="featured_image"
                   class="border p-2 rounded w-full">

            <label class="flex items-center gap-2">
                <input type="checkbox"
                       name="is_featured"
                       value="1"
                       {{ $service->is_featured ? 'checked' : '' }}>
                Featured Service
            </label>

        </div>

        <textarea name="short_description"
                  class="border p-2 rounded w-full mt-4">{{ $service->short_description }}</textarea>

        <textarea name="description"
                  rows="6"
                  class="border p-2 rounded w-full mt-3">{{ $service->description }}</textarea>

        <button class="mt-4 bg-indigo-600 text-white px-4 py-2 rounded">
            Update Service
        </button>

    </form>

</div>

@endsection