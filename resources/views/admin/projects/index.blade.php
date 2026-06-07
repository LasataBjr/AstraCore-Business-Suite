@extends('layouts.admin')
 
@section('title', 'Projects')
@section('page-title', 'Projects')
 
@section('breadcrumb')
    <span class="text-slate-300">/</span>
    <span class="text-slate-500">All Projects</span>
@endsection
@section('content')

<div class="flex justify-between mb-5">
    <h2 class="text-xl font-bold">Projects</h2>

    <a href="{{ route('admin.projects.create') }}"
       class="bg-indigo-600 text-white px-4 py-2 rounded-xl">
        + Add Project
    </a>
</div>

<table class="w-full bg-white border rounded-xl overflow-hidden">
    <thead class="bg-slate-50">
        <tr>
            <th class="p-3 text-left">Title</th>
            <th class="p-3 text-left">Category</th>
            <th class="p-3 text-left">Client</th>
            <th class="p-3 text-left">Featured</th>
            <th class="p-3 text-left">Status</th>
            <th class="p-3 text-right">Actions</th>
        </tr>
    </thead>

    <tbody>
        @foreach($projects as $project)
        <tr class="border-t">
            <td class="p-3">{{ $project->title }}</td>
            <td class="p-3">{{ $project->category->name ?? '-' }}</td>
            <td class="p-3">{{ $project->client_name ?? '-' }}</td>

            <td class="p-3">
                {{ $project->is_featured ? '⭐ Yes' : 'No' }}
            </td>

            <td class="p-3">
                <span class="px-2 py-1 rounded text-xs
                    {{ $project->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                    {{ $project->status }}
                </span>
            </td>

            <td class="p-3 text-right space-x-2">
                <a href="{{ route('admin.projects.edit', $project) }}"
                   class="text-indigo-600">Edit</a>

                <form class="inline"
                      method="POST"
                      action="{{ route('admin.projects.destroy', $project) }}">
                    @csrf
                    @method('DELETE')

                    <button onclick="return confirm('Delete project?')"
                            class="text-red-600">
                        Delete
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="mt-4">
    {{ $projects->links() }}
</div>

@endsection