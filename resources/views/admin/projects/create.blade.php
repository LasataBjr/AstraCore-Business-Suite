{{-- resources/views/admin/projects/create.blade.php --}}

@extends('layouts.admin')
 
@section('title', 'Create Project')
@section('page-title', 'Projects')
 
@section('breadcrumb')
    <span class="text-slate-300">/</span>
    <a href="{{ route('admin.projects.index') }}" class="hover:text-indigo-600 transition-colors">All Projects</a>
    <span class="text-slate-300">/</span>
    <span class="text-slate-500">New Project</span>
@endsection
 

@section('content')
<div class="p-6">

    <h1 class="text-2xl font-bold mb-4">Create Project</h1>

    <form method="POST"
          action="{{ route('admin.projects.store') }}"
          enctype="multipart/form-data">

        @csrf

        @include('admin.projects._form')

        <button class="bg-blue-600 text-white px-6 py-2 rounded mt-4">
            Save Project
        </button>

    </form>

</div>
@endsection