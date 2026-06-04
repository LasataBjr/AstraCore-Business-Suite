@extends('layouts.admin')

@section('title', 'Edit Blog')

@section('content')

<div class="bg-white p-6 rounded-2xl border">

    <h2 class="text-lg font-semibold mb-4">Edit Blog Post</h2>

    <form method="POST"
          action="{{ route('admin.blogs.update', $blog->id) }}"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <input type="text" name="title"
               value="{{ $blog->title }}"
               class="border p-2 rounded w-full mb-3">

        <select name="category_id" class="border p-2 rounded w-full mb-3">
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}"
                    {{ $blog->category_id == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>

        <select name="status" class="border p-2 rounded w-full mb-3">
            <option value="draft" {{ $blog->status=='draft'?'selected':'' }}>Draft</option>
            <option value="published" {{ $blog->status=='published'?'selected':'' }}>Published</option>
        </select>

        <textarea name="content" rows="6"
                  class="border p-2 rounded w-full mb-3">{{ $blog->content }}</textarea>

        <button class="bg-indigo-600 text-white px-4 py-2 rounded">
            Update
        </button>

    </form>

</div>

@endsection