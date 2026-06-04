@extends('layouts.admin')
 
@section('title', 'Blog Posts')
@section('page-title', 'Blog Posts')
 
@section('breadcrumb')
    <span class="text-slate-300">/</span>
    <span class="text-slate-500">All Posts</span>
@endsection
 
@section('content')
 
{{-- ── PAGE HEADER ─────────────────────────────────────────── --}}
<div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div>
        <h2 class="text-xl font-bold text-slate-800 font-display">All Blog Posts</h2>
        <p class="mt-0.5 text-sm text-slate-500">Manage, publish and organise your articles.</p>
    </div>
    <a
        href="{{ route('admin.blogs.create') }}"
        class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 active:bg-indigo-800 transition-colors"
    >
        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
        </svg>
        New Post
    </a>
</div>
 
{{-- ── STATS STRIP ─────────────────────────────────────────── --}}
<div class="mb-5 grid grid-cols-2 sm:grid-cols-4 gap-3">
    @php
        $allCount       = $posts->total();
        $publishedCount = \App\Models\BlogPost::where('status','published')->count();
        $draftCount     = \App\Models\BlogPost::where('status','draft')->count();
        $archivedCount  = \App\Models\BlogPost::where('status','archived')->count();
    @endphp
    @foreach ([
        ['Total',     $allCount,       'bg-slate-100',   'text-slate-600'],
        ['Published', $publishedCount, 'bg-emerald-100', 'text-emerald-700'],
        ['Drafts',    $draftCount,     'bg-amber-100',   'text-amber-700'],
        ['Archived',  $archivedCount,  'bg-red-100',     'text-red-700'],
    ] as [$label, $count, $bg, $text])
    <div class="rounded-xl border border-slate-200 bg-white px-4 py-3">
        <p class="text-xs text-slate-500 mb-1">{{ $label }}</p>
        <p class="text-2xl font-semibold font-display text-slate-800">{{ $count }}</p>
    </div>
    @endforeach
</div>
 
{{-- ── FILTERS + SEARCH ────────────────────────────────────── --}}
<div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center">
 
    {{-- Search --}}
    <form method="GET" action="{{ route('admin.blogs.index') }}" class="flex flex-1 items-center gap-2">
        <div class="relative flex-1 max-w-xs">
            <svg class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/>
            </svg>
            <input
                type="search"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search posts…"
                class="w-full rounded-xl border border-slate-200 bg-white py-2.5 pl-9 pr-4 text-sm text-slate-700 placeholder-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-100 transition"
            />
        </div>
 
        {{-- Status filter --}}
        <select
            name="status"
            onchange="this.form.submit()"
            class="rounded-xl border border-slate-200 bg-white py-2.5 pl-3 pr-8 text-sm text-slate-600 focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-100 transition"
        >
            <option value="">All Statuses</option>
            <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Published</option>
            <option value="draft"     {{ request('status') === 'draft'     ? 'selected' : '' }}>Draft</option>
            <option value="archived"  {{ request('status') === 'archived'  ? 'selected' : '' }}>Archived</option>
        </select>
 
        @if (request('search') || request('status'))
            <a href="{{ route('admin.blogs.index') }}" class="rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-xs font-medium text-slate-500 hover:text-slate-700 hover:border-slate-300 transition">
                Clear
            </a>
        @endif
    </form>
 
</div>
 
{{-- ── TABLE CARD ──────────────────────────────────────────── --}}
<div class="rounded-2xl border border-slate-200 bg-white overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-100">
            <thead>
                <tr class="bg-slate-50/80">
                    <th scope="col" class="px-5 py-3.5 text-left text-[11px] font-semibold uppercase tracking-wider text-slate-500 w-[35%]">Post</th>
                    <th scope="col" class="px-5 py-3.5 text-left text-[11px] font-semibold uppercase tracking-wider text-slate-500">Category</th>
                    <th scope="col" class="px-5 py-3.5 text-left text-[11px] font-semibold uppercase tracking-wider text-slate-500">Author</th>
                    <th scope="col" class="px-5 py-3.5 text-left text-[11px] font-semibold uppercase tracking-wider text-slate-500">Status</th>
                    <th scope="col" class="px-5 py-3.5 text-left text-[11px] font-semibold uppercase tracking-wider text-slate-500">Published</th>
                    <th scope="col" class="px-5 py-3.5 text-right text-[11px] font-semibold uppercase tracking-wider text-slate-500">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
 
                @forelse ($posts as $post)
                <tr class="group hover:bg-slate-50/60 transition-colors">
 
                    {{-- Post title + thumbnail + excerpt --}}
                    <td class="px-5 py-4">
                        <div class="flex items-center gap-3">
                            {{-- Thumbnail --}}
                            <div class="h-11 w-16 flex-shrink-0 overflow-hidden rounded-lg bg-slate-100">
                                @if ($post->featured_image)
                                    <img
                                        src="{{ Storage::url($post->featured_image) }}"
                                        alt="{{ $post->title }}"
                                        class="h-full w-full object-cover"
                                    />
                                @else
                                    <div class="flex h-full w-full items-center justify-center">
                                        <svg class="h-5 w-5 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>
 
                            {{-- Title + tags --}}
                            <div class="min-w-0">
                                <p class="text-sm font-semibold text-slate-700 truncate max-w-[200px]">{{ $post->title }}</p>
                                <div class="mt-1 flex flex-wrap gap-1">
                                    @foreach ($post->tags->take(3) as $tag)
                                        <span class="inline-flex rounded-full bg-indigo-50 px-2 py-0.5 text-[10px] font-medium text-indigo-600">
                                            {{ $tag->name }}
                                        </span>
                                    @endforeach
                                    @if ($post->tags->count() > 3)
                                        <span class="text-[10px] text-slate-400">+{{ $post->tags->count() - 3 }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </td>
 
                    {{-- Category --}}
                    <td class="px-5 py-4 text-sm text-slate-500">
                        {{ $post->category->name ?? '—' }}
                    </td>
 
                    {{-- Author --}}
                    <td class="px-5 py-4">
                        <div class="flex items-center gap-2">
                            <div class="flex h-6 w-6 flex-shrink-0 items-center justify-center rounded-full bg-indigo-100 text-[10px] font-semibold text-indigo-700 uppercase">
                                {{ substr($post->author->name ?? 'A', 0, 1) }}
                            </div>
                            <span class="text-sm text-slate-500">{{ $post->author->name ?? '—' }}</span>
                        </div>
                    </td>
 
                    {{-- Status badge --}}
                    <td class="px-5 py-4">
                        @php
                            $badge = [
                                'published' => ['bg-emerald-100 text-emerald-700', 'Published'],
                                'draft'     => ['bg-amber-100 text-amber-700',   'Draft'],
                                'archived'  => ['bg-slate-100 text-slate-500',   'Archived'],
                            ][$post->status] ?? ['bg-slate-100 text-slate-500', ucfirst($post->status)];
                        @endphp
                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-[11px] font-semibold {{ $badge[0] }}">
                            {{ $badge[1] }}
                        </span>
                    </td>
 
                    {{-- Published date --}}
                    <td class="px-5 py-4 text-xs text-slate-400 whitespace-nowrap">
                        {{ $post->published_at ? $post->published_at->format('M j, Y') : '—' }}
                    </td>
 
                    {{-- Action buttons --}}
                    <td class="px-5 py-4">
                        <div class="flex items-center justify-end gap-1.5">
                            {{-- View --}}
                            <a
                                href="{{ route('admin.blogs.show', $post) }}"
                                class="inline-flex h-8 w-8 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-400 hover:border-slate-300 hover:text-slate-700 transition-all"
                                title="View"
                            >
                                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </a>
 
                            {{-- Edit --}}
                            <a
                                href="{{ route('admin.blogs.edit', $post) }}"
                                class="inline-flex h-8 w-8 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-400 hover:border-indigo-300 hover:text-indigo-600 transition-all"
                                title="Edit"
                            >
                                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z"/>
                                </svg>
                            </a>
 
                            {{-- Delete --}}
                            <form
                                method="POST"
                                action="{{ route('admin.blogs.destroy', $post) }}"
                                x-data
                                @submit.prevent="if(confirm('Delete «{{ addslashes($post->title) }}»? This cannot be undone.')) $el.submit()"
                            >
                                @csrf
                                @method('DELETE')
                                <button
                                    type="submit"
                                    class="inline-flex h-8 w-8 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-400 hover:border-red-200 hover:bg-red-50 hover:text-red-600 transition-all"
                                    title="Delete"
                                >
                                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
 
                @empty
                <tr>
                    <td colspan="6" class="px-5 py-16 text-center">
                        <div class="flex flex-col items-center gap-3 text-slate-400">
                            <svg class="h-10 w-10 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.2" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z"/>
                            </svg>
                            <p class="text-sm font-medium">No blog posts found</p>
                            <a href="{{ route('admin.blogs.create') }}" class="text-xs font-semibold text-indigo-600 hover:text-indigo-800 transition-colors">
                                Write your first post →
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
 
            </tbody>
        </table>
    </div>
 
    {{-- Pagination --}}
    @if ($posts->hasPages())
    <div class="border-t border-slate-100 bg-slate-50/60 px-5 py-3.5">
        <div class="flex items-center justify-between gap-4">
            <p class="text-xs text-slate-500">
                Showing <span class="font-medium text-slate-700">{{ $posts->firstItem() }}</span>–<span class="font-medium text-slate-700">{{ $posts->lastItem() }}</span>
                of <span class="font-medium text-slate-700">{{ $posts->total() }}</span> posts
            </p>
            {{ $posts->withQueryString()->links('pagination::tailwind') }}
        </div>
    </div>
    @endif
</div>
 
@endsection