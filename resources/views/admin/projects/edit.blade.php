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
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        @include('admin.projects._form', ['project' => $project])

        <button class="bg-green-600 text-white px-6 py-2 rounded mt-4">
            Update Project
        </button>

    </form>

</div>
@endsection