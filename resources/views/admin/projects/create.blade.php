@extends('layouts.admin')

@section('title', 'Create Project')

@section('content')

<div class="mb-5">
    <h2 class="text-xl font-bold">Create Project</h2>
</div>

<form method="POST"
      action="{{ route('admin.projects.store') }}"
      enctype="multipart/form-data"
      class="space-y-6">

    @csrf

    {{-- HEADER --}}
    <div class="flex justify-between items-center">
        <h2 class="text-xl font-bold">Create Project</h2>

        <button class="bg-indigo-600 text-white px-4 py-2 rounded-xl">
            Save Project
        </button>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- LEFT --}}
        <div class="lg:col-span-2 space-y-5">

            {{-- TITLE --}}
            <div class="bg-white p-5 rounded-2xl border">
                <label class="text-sm font-semibold">Title</label>
                <input type="text" name="title"
                       class="w-full border rounded-lg p-2 mt-2">
            </div>

            {{-- DESCRIPTION --}}
            <div class="bg-white p-5 rounded-2xl border">
                <label class="text-sm font-semibold">Description</label>
                <textarea name="description" rows="6"
                          class="w-full border rounded-lg p-2 mt-2"></textarea>
            </div>

            {{-- FEATURED IMAGE --}}
            <div class="bg-white p-5 rounded-2xl border">
                <label class="text-sm font-semibold">Featured Image</label>

                <input type="file" name="featured_image"
                       class="w-full mt-3 border p-2 rounded-lg">
            </div>

            {{-- GALLERY IMAGES --}}
            <div class="bg-white p-5 rounded-2xl border">
                <label class="text-sm font-semibold">Project Gallery</label>

                <input type="file" name="images[]" multiple
                       class="w-full mt-3 border p-2 rounded-lg">

                <p class="text-xs text-slate-500 mt-2">
                    You can select multiple images.
                </p>
            </div>

        </div>

        {{-- RIGHT --}}
        <div class="space-y-5">

            {{-- CATEGORY --}}
            <div class="bg-white p-5 rounded-2xl border">
                <label class="text-sm font-semibold">Category</label>
                <select name="category_id" class="w-full border rounded-lg p-2 mt-2">
                    <option value="">Select Category</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- CLIENT --}}
            <div class="bg-white p-5 rounded-2xl border">
                <label class="text-sm font-semibold">Client Name</label>
                <input type="text" name="client_name"
                       class="w-full border rounded-lg p-2 mt-2">
            </div>

            {{-- PROJECT URL --}}
            <div class="bg-white p-5 rounded-2xl border">
                <label class="text-sm font-semibold">Project URL</label>
                <input type="text" name="project_url"
                       class="w-full border rounded-lg p-2 mt-2">
            </div>

            {{-- STATUS --}}
            <div class="bg-white p-5 rounded-2xl border">
                <label class="text-sm font-semibold">Status</label>
                <select name="status" class="w-full border rounded-lg p-2 mt-2">
                    <option value="inactive">Inactive</option>
                    <option value="active">Active</option>
                </select>
            </div>

            {{-- FEATURED --}}
            <div class="bg-white p-5 rounded-2xl border">
                <label class="flex items-center gap-2 text-sm">
                    <input type="checkbox" name="is_featured" value="1">
                    Featured Project
                </label>
            </div>

        </div>
    </div>
</form>

@endsection