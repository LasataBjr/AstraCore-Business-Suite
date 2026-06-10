@extends('layouts.admin')

@section('title', 'Blog Tags')
@section('page-title', 'Blog Tags')

@section('breadcrumb')
    <span class="text-slate-300">/</span>
    <span class="text-slate-500">Tags</span>
@endsection

@section('content')

{{-- ══════════════════════════════════════════════════════════════
     ALPINE ROOT — shared state for edit modal
══════════════════════════════════════════════════════════════ --}}
<div x-data="tagsPage()">

    {{-- ── PAGE HEADER ─────────────────────────────────────── --}}
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-xl font-bold text-slate-800 font-display">Blog Tags</h2>
            <p class="mt-0.5 text-sm text-slate-500">Create and manage tags used to organise blog posts.</p>
        </div>
        <div class="flex items-center gap-2">
            <span class="rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700">
                {{ $tags->total() }} {{ Str::plural('tag', $tags->total()) }}
            </span>
        </div>
    </div>

    {{-- ── TWO-COLUMN LAYOUT ───────────────────────────────── --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

        {{-- ══════════════════════════════════════════
             LEFT — Create form (1/3)
        ══════════════════════════════════════════ --}}
        <div class="space-y-5">

            {{-- Create tag form --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-6">

                <h3 class="mb-5 flex items-center gap-2 text-sm font-semibold text-slate-700">
                    <span class="flex h-6 w-6 items-center justify-center rounded-md bg-indigo-100">
                        <svg class="h-3.5 w-3.5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z M6 6h.008v.008H6V6z"/>
                        </svg>
                    </span>
                    Add New Tag
                </h3>

                <form
                    method="POST"
                    action="{{ route('admin.tags.store') }}"
                    x-data="{ name: '', slug: '' }"
                    novalidate
                >
                    @csrf

                    {{-- Name --}}
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-slate-700 mb-1.5">
                            Tag Name <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="e.g. Laravel, Web Design…"
                            x-model="name"
                            @input="slug = name.toLowerCase().replace(/[^a-z0-9\s-]/g,'').trim().replace(/\s+/g,'-').replace(/-+/g,'-')"
                            maxlength="255"
                            autofocus
                            class="w-full rounded-xl border bg-slate-50 px-4 py-3 text-sm text-slate-800 placeholder-slate-400
                                focus:bg-white focus:outline-none focus:ring-2 transition
                                @error('name') border-red-300 bg-red-50 focus:border-red-400 focus:ring-red-100
                                @else border-slate-200 focus:border-indigo-400 focus:ring-indigo-100 @enderror"
                        />
                        @error('name')
                            <p class="mt-1.5 flex items-center gap-1 text-xs text-red-600">
                                <svg class="h-3.5 w-3.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/></svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Slug preview --}}
                    <div class="mb-5 rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5">
                        <p class="text-[10px] font-medium text-slate-400 mb-1 uppercase tracking-wider">Auto slug</p>
                        <div class="flex items-center gap-2">
                            <svg class="h-3.5 w-3.5 flex-shrink-0 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244"/>
                            </svg>
                            <code class="text-sm font-mono text-indigo-600" x-text="slug || 'tag-slug'"></code>
                        </div>
                    </div>

                    <button
                        type="submit"
                        class="w-full inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 active:bg-indigo-800 transition-colors"
                    >
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                        </svg>
                        Create Tag
                    </button>
                </form>
            </div>

            {{-- Quick stats --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5">
                <h3 class="mb-4 text-sm font-semibold text-slate-700">Overview</h3>
                <dl class="space-y-3">
                    <div class="flex items-center justify-between">
                        <dt class="text-xs text-slate-500">Total tags</dt>
                        <dd class="text-sm font-semibold text-slate-800">{{ \App\Models\Tag::count() }}</dd>
                    </div>
                    <div class="flex items-center justify-between">
                        <dt class="text-xs text-slate-500">Used in posts</dt>
                        <dd class="text-sm font-semibold text-slate-800">
                            {{ \App\Models\Tag::has('posts')->count() }}
                        </dd>
                    </div>
                    <div class="flex items-center justify-between">
                        <dt class="text-xs text-slate-500">Unused tags</dt>
                        <dd class="text-sm font-semibold text-slate-800">
                            {{ \App\Models\Tag::doesntHave('posts')->count() }}
                        </dd>
                    </div>
                </dl>
            </div>

            {{-- Tips card --}}
            <div class="rounded-2xl border border-indigo-100 bg-indigo-50/60 p-5">
                <div class="flex items-start gap-3">
                    <div class="flex h-7 w-7 flex-shrink-0 items-center justify-center rounded-lg bg-indigo-100">
                        <svg class="h-4 w-4 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-indigo-800 mb-2">Tips</p>
                        <ul class="space-y-1.5 text-xs text-indigo-700">
                            <li class="flex items-start gap-1.5">
                                <svg class="mt-0.5 h-3 w-3 flex-shrink-0 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                                Slug is auto-generated from the name
                            </li>
                            <li class="flex items-start gap-1.5">
                                <svg class="mt-0.5 h-3 w-3 flex-shrink-0 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                                Tag names must be unique
                            </li>
                            <li class="flex items-start gap-1.5">
                                <svg class="mt-0.5 h-3 w-3 flex-shrink-0 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                                Click the pencil icon to edit inline
                            </li>
                            <li class="flex items-start gap-1.5">
                                <svg class="mt-0.5 h-3 w-3 flex-shrink-0 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                                Deleting a tag removes it from all posts
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>

        {{-- ══════════════════════════════════════════
             RIGHT — Tag list table (2/3)
        ══════════════════════════════════════════ --}}
        <div class="lg:col-span-2 space-y-4">

            {{-- Search bar --}}
            <form method="GET" action="{{ route('admin.tags.index') }}" class="flex items-center gap-2">
                <div class="relative flex-1">
                    <svg class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/>
                    </svg>
                    <input
                        type="search"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search tags by name…"
                        class="w-full rounded-xl border border-slate-200 bg-white py-2.5 pl-9 pr-4 text-sm text-slate-700 placeholder-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-100 transition"
                    />
                </div>
                <button type="submit" class="rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-medium text-slate-600 hover:border-indigo-300 hover:text-indigo-700 transition-colors">
                    Search
                </button>
                @if (request('search'))
                    <a href="{{ route('admin.tags.index') }}" class="rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-xs font-medium text-slate-500 hover:text-slate-700 transition">Clear</a>
                @endif
            </form>

            {{-- Tag table --}}
            <div class="rounded-2xl border border-slate-200 bg-white overflow-hidden">

                @if ($tags->isEmpty())
                {{-- Empty state --}}
                <div class="flex flex-col items-center justify-center py-16 text-slate-400">
                    <svg class="h-10 w-10 text-slate-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z M6 6h.008v.008H6V6z"/>
                    </svg>
                    <p class="text-sm font-medium mb-1">
                        {{ request('search') ? 'No tags match your search' : 'No tags yet' }}
                    </p>
                    <p class="text-xs">
                        {{ request('search') ? 'Try a different keyword.' : 'Use the form on the left to create your first tag.' }}
                    </p>
                </div>
                @else

                <table class="min-w-full divide-y divide-slate-100">
                    <thead>
                        <tr class="bg-slate-50/80">
                            <th scope="col" class="px-5 py-3.5 text-left text-[11px] font-semibold uppercase tracking-wider text-slate-500 w-8">#</th>
                            <th scope="col" class="px-5 py-3.5 text-left text-[11px] font-semibold uppercase tracking-wider text-slate-500">Name</th>
                            <th scope="col" class="px-5 py-3.5 text-left text-[11px] font-semibold uppercase tracking-wider text-slate-500">Slug</th>
                            <th scope="col" class="px-5 py-3.5 text-left text-[11px] font-semibold uppercase tracking-wider text-slate-500">Posts</th>
                            <th scope="col" class="px-5 py-3.5 text-left text-[11px] font-semibold uppercase tracking-wider text-slate-500">Created</th>
                            <th scope="col" class="px-5 py-3.5 text-right text-[11px] font-semibold uppercase tracking-wider text-slate-500">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach ($tags as $tag)
                        <tr class="group hover:bg-slate-50/60 transition-colors">

                            {{-- Row number --}}
                            <td class="px-5 py-3.5 text-xs text-slate-400 font-mono">
                                {{ ($tags->currentPage() - 1) * $tags->perPage() + $loop->iteration }}
                            </td>

                            {{-- Tag name --}}
                            <td class="px-5 py-3.5">
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-indigo-50 px-3 py-1 text-sm font-medium text-indigo-700">
                                    <span class="h-1.5 w-1.5 rounded-full bg-indigo-400"></span>
                                    {{ $tag->name }}
                                </span>
                            </td>

                            {{-- Slug --}}
                            <td class="px-5 py-3.5">
                                <code class="rounded-lg bg-slate-100 px-2.5 py-1 font-mono text-[11px] text-slate-600">
                                    {{ $tag->slug }}
                                </code>
                            </td>

                            {{-- Post count --}}
                            <td class="px-5 py-3.5">
                                @php $postCount = $tag->posts()->count(); @endphp
                                @if ($postCount > 0)
                                    <span class="inline-flex items-center gap-1 rounded-full bg-emerald-100 px-2.5 py-0.5 text-[11px] font-semibold text-emerald-700">
                                        {{ $postCount }} {{ Str::plural('post', $postCount) }}
                                    </span>
                                @else
                                    <span class="text-xs text-slate-400">Unused</span>
                                @endif
                            </td>

                            {{-- Created --}}
                            <td class="px-5 py-3.5 text-xs text-slate-400 whitespace-nowrap">
                                {{ $tag->created_at->format('M j, Y') }}
                            </td>

                            {{-- Actions --}}
                            <td class="px-5 py-3.5">
                                <div class="flex items-center justify-end gap-1.5">

                                    {{-- Edit — opens modal --}}
                                    <button
                                        type="button"
                                        @click="openEdit({{ $tag->id }}, '{{ addslashes($tag->name) }}', '{{ $tag->slug }}')"
                                        class="inline-flex h-8 w-8 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-400 hover:border-indigo-300 hover:text-indigo-600 transition-all"
                                        title="Edit tag"
                                    >
                                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z"/>
                                        </svg>
                                    </button>

                                    {{-- Delete --}}
                                    <form
                                        method="POST"
                                        action="{{ route('admin.tags.destroy', $tag) }}"
                                        x-data
                                        @submit.prevent="if(confirm('Delete tag «{{ addslashes($tag->name) }}»?{{ $tag->posts()->count() > 0 ? '\n\nWarning: this tag is used in ' . $tag->posts()->count() . ' post(s). It will be removed from those posts.' : '' }}')) $el.submit()"
                                    >
                                        @csrf @method('DELETE')
                                        <button
                                            type="submit"
                                            class="inline-flex h-8 w-8 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-400 hover:border-red-200 hover:bg-red-50 hover:text-red-600 transition-all"
                                            title="Delete tag"
                                        >
                                            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                            </svg>
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Pagination --}}
                @if ($tags->hasPages())
                <div class="border-t border-slate-100 bg-slate-50/60 px-5 py-3.5">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                        <p class="text-xs text-slate-500">
                            Showing <span class="font-medium text-slate-700">{{ $tags->firstItem() }}</span>–<span class="font-medium text-slate-700">{{ $tags->lastItem() }}</span>
                            of <span class="font-medium text-slate-700">{{ $tags->total() }}</span> tags
                        </p>
                        {{ $tags->withQueryString()->links('pagination::tailwind') }}
                    </div>
                </div>
                @endif

                @endif
            </div>

        </div>{{-- end right --}}
    </div>{{-- end grid --}}


    {{-- ══════════════════════════════════════════════════════════
         EDIT MODAL — Alpine.js, no separate page needed
    ══════════════════════════════════════════════════════════ --}}
    <div
        x-show="editOpen"
        x-transition:enter="transition-opacity duration-200 ease-out"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity duration-150 ease-in"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click.self="editOpen = false"
        @keydown.escape.window="editOpen = false"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm p-4"
        style="display:none"
        role="dialog"
        aria-modal="true"
        aria-labelledby="editModalTitle"
    >
        {{-- Modal panel --}}
        <div
            x-show="editOpen"
            x-transition:enter="transition duration-200 ease-out"
            x-transition:enter-start="opacity-0 scale-95 translate-y-2"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            x-transition:leave="transition duration-150 ease-in"
            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
            x-transition:leave-end="opacity-0 scale-95 translate-y-2"
            class="w-full max-w-md rounded-2xl border border-slate-200 bg-white shadow-xl"
            @click.stop
        >
            {{-- Modal header --}}
            <div class="flex items-center justify-between border-b border-slate-100 px-6 py-4">
                <div class="flex items-center gap-2.5">
                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-indigo-100">
                        <svg class="h-4 w-4 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z"/>
                        </svg>
                    </div>
                    <h3 id="editModalTitle" class="text-sm font-semibold text-slate-800">Edit Tag</h3>
                </div>
                <button
                    type="button"
                    @click="editOpen = false"
                    class="flex h-8 w-8 items-center justify-center rounded-lg text-slate-400 hover:bg-slate-100 hover:text-slate-600 transition-colors"
                    aria-label="Close modal"
                >
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            {{-- Modal form --}}
            <form
                method="POST"
                :action="editAction"
                x-ref="editForm"
                novalidate
            >
                @csrf
                @method('PUT')

                <div class="px-6 py-5 space-y-4">

                    {{-- Current tag pill --}}
                    <div class="flex items-center gap-2 rounded-xl bg-slate-50 px-3 py-2 border border-slate-200">
                        <span class="text-[11px] font-medium text-slate-500">Current:</span>
                        <span class="inline-flex items-center gap-1.5 rounded-full bg-indigo-50 px-2.5 py-0.5 text-xs font-medium text-indigo-700">
                            <span class="h-1.5 w-1.5 rounded-full bg-indigo-400"></span>
                            <span x-text="editOriginalName"></span>
                        </span>
                    </div>

                    {{-- Name field --}}
                    <div>
                        <label :for="'edit_name_' + editId" class="block text-sm font-medium text-slate-700 mb-1.5">
                            New Tag Name <span class="text-red-500">*</span>
                        </label>
                        <input
                            type="text"
                            :id="'edit_name_' + editId"
                            name="name"
                            x-model="editName"
                            @input="editSlug = editName.toLowerCase().replace(/[^a-z0-9\s-]/g,'').trim().replace(/\s+/g,'-').replace(/-+/g,'-')"
                            placeholder="Enter tag name…"
                            maxlength="255"
                            x-ref="editNameInput"
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 placeholder-slate-400
                                focus:border-indigo-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-100 transition"
                        />
                    </div>

                    {{-- New slug preview --}}
                    <div class="rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5">
                        <p class="text-[10px] font-medium text-slate-400 mb-1 uppercase tracking-wider">New slug</p>
                        <div class="flex items-center gap-2">
                            <svg class="h-3.5 w-3.5 flex-shrink-0 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244"/>
                            </svg>
                            <code class="text-sm font-mono text-indigo-600" x-text="editSlug || 'tag-slug'"></code>
                        </div>
                    </div>

                </div>

                {{-- Modal footer --}}
                <div class="flex items-center justify-end gap-2.5 border-t border-slate-100 px-6 py-4">
                    <button
                        type="button"
                        @click="editOpen = false"
                        class="rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-medium text-slate-600 hover:border-slate-300 hover:text-slate-800 transition-colors"
                    >
                        Cancel
                    </button>
                    <button
                        type="submit"
                        class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-indigo-700 active:bg-indigo-800 transition-colors"
                    >
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                        </svg>
                        Update Tag
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>{{-- end Alpine root --}}

@endsection

@push('scripts')
<script>
function tagsPage() {
    return {
        // Edit modal state
        editOpen:         false,
        editId:           null,
        editName:         '',
        editOriginalName: '',
        editSlug:         '',
        editAction:       '',

        openEdit(id, name, slug) {
            this.editId           = id;
            this.editName         = name;
            this.editOriginalName = name;
            this.editSlug         = slug;
            this.editAction       = `/admin/tags/${id}`;
            this.editOpen         = true;

            // Focus input after modal opens
            this.$nextTick(() => {
                this.$refs.editNameInput?.focus();
                this.$refs.editNameInput?.select();
            });
        },
    }
}
</script>
@endpush