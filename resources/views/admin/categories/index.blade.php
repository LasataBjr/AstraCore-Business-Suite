@extends('layouts.admin')

@section('title', 'Categories')

@section('content')

<div class="flex items-center justify-between mb-6">
    <h1 class="text-xl font-semibold text-slate-800">Categories</h1>

    <a href="{{ route('admin.categories.create') }}"
       class="px-4 py-2 bg-indigo-600 text-white text-sm rounded-lg hover:bg-indigo-700">
        + Create Category
    </a>
</div>

@if(session('success'))
    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-lg text-sm">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white border rounded-xl overflow-hidden">

    <table class="w-full text-sm">
        <thead class="bg-slate-50 text-left text-xs uppercase text-slate-500">
            <tr>
                <th class="p-4">Name</th>
                <th class="p-4">Slug</th>
                <th class="p-4">Status</th>
                <th class="p-4 text-right">Actions</th>
            </tr>
        </thead>

        <tbody class="divide-y">
            @forelse($categories as $category)
                <tr class="hover:bg-slate-50">

                    <td class="p-4 font-medium text-slate-700">
                        {{ $category->name }}
                    </td>

                    <td class="p-4 text-slate-500">
                        {{ $category->slug }}
                    </td>

                    <td class="p-4">
                        <span class="px-2 py-1 text-xs rounded-full
                            {{ $category->status === 'active'
                                ? 'bg-green-100 text-green-700'
                                : 'bg-red-100 text-red-700' }}">
                            {{ $category->status }}
                        </span>
                    </td>

                    <td class="p-4 text-right space-x-2">

                        <a href="{{ route('admin.categories.show', $category) }}"
                           class="text-xs text-blue-600 hover:underline">
                            View
                        </a>

                        <a href="{{ route('admin.categories.edit', $category) }}"
                           class="text-xs text-indigo-600 hover:underline">
                            Edit
                        </a>

                        <form action="{{ route('admin.categories.destroy', $category) }}"
                              method="POST"
                              class="inline-block"
                              onsubmit="return confirm('Delete this category?')">
                            @csrf
                            @method('DELETE')

                            <button class="text-xs text-red-600 hover:underline">
                                Delete
                            </button>
                        </form>

                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="p-6 text-center text-slate-400">
                        No categories found
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

<div class="mt-4">
    {{ $categories->links() }}
</div>

@endsection