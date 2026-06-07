@extends('layouts.admin')
 
@section('title', 'Edit: ' . $project->title)
@section('page-title', 'Projects')
 
@section('breadcrumb')
    <span class="text-slate-300">/</span>
    <a href="{{ route('admin.projects.index') }}" class="hover:text-indigo-600 transition-colors">All Projects</a>
    <span class="text-slate-300">/</span>
    <span class="text-slate-500 truncate max-w-[160px]">{{ Str::limit($project->title, 30) }}</span>
@endsection

@section('content')
<div class="p-6">

    <h1 class="text-2xl font-bold mb-4">Edit Project</h1>

    <form method="POST"
          action="{{ route('admin.projects.update', $project) }}"
          enctype="multipart/form-data"
          class="space-y-6">

        @csrf
        @method('PUT')

        {{-- HEADER --}}
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-bold">Edit Project</h2>

            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-xl hover:bg-indigo-700 transition-colors">
                Update Project
            </button>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- LEFT --}}
            <div class="lg:col-span-2 space-y-5">

                {{-- TITLE --}}
                <div class="bg-white p-5 rounded-2xl border">
                    <label class="text-sm font-semibold">Title</label>
                    <input type="text" name="title"
                           value="{{ $project->title }}"
                           class="w-full border rounded-lg p-2 mt-2">
                </div>

                {{-- DESCRIPTION --}}
                <div class="bg-white p-5 rounded-2xl border">
                    <label class="text-sm font-semibold">Description</label>
                    <textarea name="description" rows="6"
                              class="w-full border rounded-lg p-2 mt-2">{{ $project->description }}</textarea>
                </div>

                {{-- FEATURED IMAGE --}}
                <div class="bg-white p-5 rounded-2xl border">
                    <label class="text-sm font-semibold">Featured Image</label>

                    @if($project->featured_image)
                        <img src="{{ Storage::url($project->featured_image) }}"
                             class="h-40 mt-3 rounded-lg object-cover">
                    @endif

                    <input type="file" name="featured_image"
                           class="w-full mt-3 border p-2 rounded-lg">
                </div>

                {{-- GALLERY IMAGES --}}
                <div class="bg-white p-5 rounded-2xl border">
                    <label class="text-sm font-semibold">Project Gallery</label>

                    <input type="file" name="images[]" multiple
                           class="w-full mt-3 border p-2 rounded-lg">

                    {{-- EXISTING IMAGES --}}
                    <div class="grid grid-cols-3 gap-2 mt-4">
                        @foreach($project->images as $img)
                            <div class="relative group">
                                <img src="{{ Storage::url($img->image) }}"
                                     class="h-24 w-full object-cover rounded-lg">

                                <button type="submit" 
                                        form="delete-image-form-{{ $img->id }}"
                                        class="absolute top-1 right-1 bg-red-500 hover:bg-red-600 text-white text-xs px-2 py-1 rounded shadow-md transition-colors">
                                    X
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>

            {{-- RIGHT --}}
            <div class="space-y-5">

                {{-- CATEGORY --}}
                <div class="bg-white p-5 rounded-2xl border">
                    <label class="text-sm font-semibold">Category</label>

                    <select name="category_id"
                            class="w-full border rounded-lg p-2 mt-2">
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}"
                                {{ $project->category_id == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- CLIENT --}}
                <div class="bg-white p-5 rounded-2xl border">
                    <label class="text-sm font-semibold">Client Name</label>
                    <input type="text" name="client_name"
                           value="{{ $project->client_name }}"
                           class="w-full border rounded-lg p-2 mt-2">
                </div>

                {{-- URL --}}
                <div class="bg-white p-5 rounded-2xl border">
                    <label class="text-sm font-semibold">Project URL</label>
                    <input type="text" name="project_url"
                           value="{{ $project->project_url }}"
                           class="w-full border rounded-lg p-2 mt-2">
                </div>

                {{-- STATUS --}}
                <div class="bg-white p-5 rounded-2xl border">
                    <label class="text-sm font-semibold block mb-2">Status</label>
                    <select name="status" class="w-full border rounded-lg p-2">
                        <option value="active" {{ $project->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $project->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                {{-- FEATURED --}}
                <div class="bg-white p-5 rounded-2xl border">
                    <label class="flex items-center gap-2 text-sm cursor-pointer">
                        <input type="checkbox" name="is_featured" value="1"
                            {{ $project->is_featured ? 'checked' : '' }}>
                        Featured Project
                    </label>
                </div>

            </div>
        </div>

    </form> {{-- EXTRA: Independent Image Delete Forms placed safely outside the main workflow --}}
    @foreach($project->images as $img)
        <form id="delete-image-form-{{ $img->id }}" 
              method="POST" 
              action="#" 
              class="hidden">
            @csrf
            @method('DELETE')
        </form>
    @endforeach

</div>
@endsection