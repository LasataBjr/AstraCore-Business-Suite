@extends('layouts.admin')

@section('title', 'Tags')

@section('breadcrumb')
    <span class="text-slate-300">/</span>
    <span class="text-slate-500">All Tags</span>
@endsection

@section('content')

<div class="flex items-center justify-between mb-6">
    <div>
        <h2 class="text-xl font-bold">Tags</h2>
        <p class="text-sm text-slate-500">
            Manage blog tags
        </p>
    </div>

    <a href="{{ route('admin.tags.create') }}"
       class="px-4 py-2 bg-indigo-600 text-white rounded-xl">
        Add Tag
    </a>
</div>

<form method="GET" class="mb-4">
    <input
        type="text"
        name="search"
        value="{{ request('search') }}"
        placeholder="Search tags..."
        class="border rounded-lg px-3 py-2"
    >
</form>

<div class="bg-white rounded-2xl border overflow-hidden">

    <table class="w-full">
        <thead class="bg-slate-50">
            <tr>
                <th class="p-4 text-left">Name</th>
                <th class="p-4 text-left">Slug</th>
                <th class="p-4 text-right">Actions</th>
            </tr>
        </thead>

        <tbody>

            @forelse($tags as $tag)

            <tr class="border-t">

                <td class="p-4">
                    {{ $tag->name }}
                </td>

                <td class="p-4">
                    {{ $tag->slug }}
                </td>

                <td class="p-4">

                    <div class="flex justify-end gap-2">

                        <a href="{{ route('admin.tags.edit', $tag) }}"
                           class="px-3 py-1 border rounded-lg">
                            Edit
                        </a>

                        <form method="POST"
                              action="{{ route('admin.tags.destroy', $tag) }}">
                            @csrf
                            @method('DELETE')

                            <button
                                onclick="return confirm('Delete tag?')"
                                class="px-3 py-1 bg-red-500 text-white rounded-lg">
                                Delete
                            </button>
                        </form>

                    </div>

                </td>

            </tr>

            @empty

            <tr>
                <td colspan="3" class="p-10 text-center text-slate-500">
                    No tags found.
                </td>
            </tr>

            @endforelse

        </tbody>
    </table>

</div>

<div class="mt-4">
    {{ $tags->links() }}
</div>

@endsection