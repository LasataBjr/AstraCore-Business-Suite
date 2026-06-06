@extends('layouts.admin')
 
@section('title', 'Projects')
@section('page-title', 'Projects')
 
@section('breadcrumb')
    <span class="text-slate-300">/</span>
    <span class="text-slate-500">All Projects</span>
@endsection
@section('content')
<div class="p-6">

    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Projects</h1>

        <a href="{{ route('admin.projects.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded">
            + Create Project
        </a>
    </div>

    {{-- Search --}}
    <form method="GET" class="mb-4 flex gap-2">
        <input type="text" name="search"
               value="{{ request('search') }}"
               placeholder="Search projects..."
               class="border p-2 rounded w-64">

        <select name="status" class="border p-2 rounded">
            <option value="">All Status</option>
            <option value="1" @selected(request('status')==='1')>Active</option>
            <option value="0" @selected(request('status')==='0')>Inactive</option>
        </select>

        <button class="bg-gray-800 text-white px-4 rounded">Filter</button>
    </form>

    {{-- Table --}}
    <div class="bg-white shadow rounded overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3">Title</th>
                    <th class="p-3">Category</th>
                    <th class="p-3">Featured</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($projects as $project)
                <tr class="border-t">
                    <td class="p-3">{{ $project->title }}</td>
                    <td class="p-3">{{ $project->category->name ?? '-' }}</td>
                    <td class="p-3">
                        {{ $project->is_featured ? 'Yes' : 'No' }}
                    </td>
                    <td class="p-3">
                        {{ $project->status ? 'Active' : 'Inactive' }}
                    </td>

                    <td class="p-3 flex gap-2">
                        <a href="{{ route('admin.projects.show', $project) }}"
                           class="text-blue-600">View</a>

                        <a href="{{ route('admin.projects.edit', $project) }}"
                           class="text-green-600">Edit</a>

                        <form method="POST"
                              action="{{ route('admin.projects.destroy', $project) }}"
                              onsubmit="return confirm('Delete this project?')">
                            @csrf
                            @method('DELETE')

                            <button class="text-red-600">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $projects->links() }}
    </div>

</div>
@endsection