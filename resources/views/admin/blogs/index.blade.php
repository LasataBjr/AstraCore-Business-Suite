@extends('layouts.admin')

@section('title', 'Blogs')
@section('page-title', 'Blog Posts')

@section('content')

<div class="flex items-center justify-between mb-6">
    <h2 class="text-lg font-semibold text-slate-700">All Blog Posts</h2>

    <a href="{{ route('admin.blogs.create') }}"
       class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-indigo-700">
        + New Post
    </a>
</div>

<div class="bg-white border rounded-2xl overflow-hidden">

    <table class="min-w-full divide-y divide-slate-100">
        <thead class="bg-slate-50">
            <tr>
                <th class="px-4 py-3 text-left text-xs font-semibold">Title</th>
                <th class="px-4 py-3 text-left text-xs font-semibold">Category</th>
                <th class="px-4 py-3 text-left text-xs font-semibold">Status</th>
                <th class="px-4 py-3 text-left text-xs font-semibold">Date</th>
                <th class="px-4 py-3 text-right text-xs font-semibold">Actions</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-slate-100">
        @forelse($posts as $post)
            <tr class="hover:bg-slate-50">

                <td class="px-4 py-3 text-sm font-medium text-slate-700">
                    {{ $post->title }}
                </td>

                <td class="px-4 py-3 text-sm text-slate-500">
                    {{ $post->category->name ?? '-' }}
                </td>

                <td class="px-4 py-3">
                    <span class="text-xs px-2 py-1 rounded-full
                        {{ $post->status === 'published' ? 'bg-green-100 text-green-700' : 'bg-slate-100 text-slate-600' }}">
                        {{ $post->status }}
                    </span>
                </td>

                <td class="px-4 py-3 text-xs text-slate-400">
                    {{ $post->created_at->format('M d, Y') }}
                </td>

                <td class="px-4 py-3 text-right space-x-2">

                    <a href="{{ route('admin.blogs.show', $post->id) }}"
                       class="text-blue-600 text-xs">View</a>

                    <a href="{{ route('admin.blogs.edit', $post->id) }}"
                       class="text-indigo-600 text-xs">Edit</a>

                    <form action="{{ route('admin.blogs.destroy', $post->id) }}"
                          method="POST" class="inline">
                        @csrf
                        @method('DELETE')

                        <button class="text-red-500 text-xs"
                                onclick="return confirm('Delete this post?')">
                            Delete
                        </button>
                    </form>

                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center py-10 text-slate-400">
                    No blog posts found
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>

</div>

@endsection