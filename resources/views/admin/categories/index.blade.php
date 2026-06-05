{{--
    Categories — Index Page
    Path: resources/views/admin/categories/index.blade.php
    Controller: App\Http\Controllers\Admin\CategoryController@index
--}}

@extends('layouts.admin')

@section('title', 'Categories')
@section('page-title', 'Categories')

@section('breadcrumb')
    <span class="text-slate-300">/</span>
    <span class="text-slate-500">All Categories</span>
@endsection

@section('content')

{{-- ── PAGE HEADER ─────────────────────────────────────────── --}}
<div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div>
        <h2 class="text-xl font-bold text-slate-800 font-display">Categories</h2>
        <p class="mt-0.5 text-sm text-slate-500">Organise your services, projects and blog posts.</p>
    </div>
    <a
        href="{{ route('admin.categories.create') }}"
        class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 active:bg-indigo-800 transition-colors"
    >
        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
        </svg>
        New Category
    </a>
</div>

{{-- ── STATS STRIP ─────────────────────────────────────────── --}}
<div class="mb-5 grid grid-cols-2 sm:grid-cols-3 gap-3">
    @php
        $totalCount    = $categories->total();
        $activeCount   = \App\Models\Category::where('status','active')->count();
        $inactiveCount = \App\Models\Category::where('status','inactive')->count();
    @endphp

    @foreach ([
        ['Total',    $totalCount,    'bg-slate-100',   'text-slate-700'],
        ['Active',   $activeCount,   'bg-emerald-100', 'text-emerald-700'],
        ['Inactive', $inactiveCount, 'bg-red-100',     'text-red-700'],
    ] as [$label, $count, $bg, $text])
    <div class="rounded-xl border border-slate-200 bg-white px-4 py-3">
        <p class="text-xs text-slate-500 mb-1">{{ $label }}</p>
        <p class="text-2xl font-semibold font-display text-slate-800">{{ $count }}</p>
    </div>
    @endforeach
</div>

{{-- ── SEARCH + FILTER BAR ─────────────────────────────────── --}}
<div class="mb-4 flex flex-col gap-3 sm:flex-row sm:items-center">
    <form method="GET" action="{{ route('admin.categories.index') }}" class="flex flex-1 items-center gap-2">
        <div class="relative flex-1 max-w-xs">
            <svg class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/>
            </svg>
            <input
                type="search"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search categories…"
                class="w-full rounded-xl border border-slate-200 bg-white py-2.5 pl-9 pr-4 text-sm text-slate-700 placeholder-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-100 transition"
            />
        </div>

        <select
            name="status"
            onchange="this.form.submit()"
            class="rounded-xl border border-slate-200 bg-white py-2.5 pl-3 pr-8 text-sm text-slate-600 focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-100 transition"
        >
            <option value="">All Statuses</option>
            <option value="active"   {{ request('status') === 'active'   ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
        </select>

        @if (request('search') || request('status'))
            <a href="{{ route('admin.categories.index') }}" class="rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-xs font-medium text-slate-500 hover:text-slate-700 hover:border-slate-300 transition">
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
                    <th scope="col" class="px-5 py-3.5 text-left text-[11px] font-semibold uppercase tracking-wider text-slate-500">#</th>
                    <th scope="col" class="px-5 py-3.5 text-left text-[11px] font-semibold uppercase tracking-wider text-slate-500">Name</th>
                    <th scope="col" class="px-5 py-3.5 text-left text-[11px] font-semibold uppercase tracking-wider text-slate-500">Slug</th>
                    <th scope="col" class="px-5 py-3.5 text-left text-[11px] font-semibold uppercase tracking-wider text-slate-500">Description</th>
                    <th scope="col" class="px-5 py-3.5 text-left text-[11px] font-semibold uppercase tracking-wider text-slate-500">Usage</th>
                    <th scope="col" class="px-5 py-3.5 text-left text-[11px] font-semibold uppercase tracking-wider text-slate-500">Status</th>
                    <th scope="col" class="px-5 py-3.5 text-right text-[11px] font-semibold uppercase tracking-wider text-slate-500">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">

                @forelse ($categories as $category)
                <tr class="group hover:bg-slate-50/60 transition-colors">

                    {{-- Row number --}}
                    <td class="px-5 py-4 text-xs text-slate-400 font-mono">
                        {{ ($categories->currentPage() - 1) * $categories->perPage() + $loop->iteration }}
                    </td>

                    {{-- Name --}}
                    <td class="px-5 py-4">
                        <div class="flex items-center gap-3">
                            {{-- Color dot avatar --}}
                            <div class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-lg bg-indigo-100 text-xs font-bold text-indigo-700 uppercase">
                                {{ substr($category->name, 0, 1) }}
                            </div>
                            <span class="text-sm font-semibold text-slate-700">{{ $category->name }}</span>
                        </div>
                    </td>

                    {{-- Slug --}}
                    <td class="px-5 py-4">
                        <span class="inline-flex items-center gap-1 rounded-lg bg-slate-100 px-2.5 py-1 font-mono text-[11px] text-slate-500">
                            {{ $category->slug }}
                        </span>
                    </td>

                    {{-- Description --}}
                    <td class="px-5 py-4 text-sm text-slate-500 max-w-[220px]">
                        <span class="truncate block">
                            {{ $category->description ? Str::limit($category->description, 50) : '—' }}
                        </span>
                    </td>

                    {{-- Usage counts --}}
                    <td class="px-5 py-4">
                        <div class="flex items-center gap-2 text-xs text-slate-500">
                            <span title="Services"  class="inline-flex items-center gap-1 rounded-md bg-violet-50 px-2 py-0.5 text-violet-700 font-medium">
                                <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877"/></svg>
                                {{ $category->services_count ?? $category->services()->count() }}
                            </span>
                            <span title="Projects" class="inline-flex items-center gap-1 rounded-md bg-blue-50 px-2 py-0.5 text-blue-700 font-medium">
                                <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M6.429 9.75L2.25 12l4.179 2.25"/></svg>
                                {{ $category->projects_count ?? $category->projects()->count() }}
                            </span>
                            <span title="Posts" class="inline-flex items-center gap-1 rounded-md bg-emerald-50 px-2 py-0.5 text-emerald-700 font-medium">
                                <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5"/></svg>
                                {{ $category->posts_count ?? $category->posts()->count() }}
                            </span>
                        </div>
                    </td>

                    {{-- Status --}}
                    <td class="px-5 py-4">
                        @if ($category->status === 'active')
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-100 px-2.5 py-0.5 text-[11px] font-semibold text-emerald-700">
                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                Active
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-slate-100 px-2.5 py-0.5 text-[11px] font-semibold text-slate-500">
                                <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span>
                                Inactive
                            </span>
                        @endif
                    </td>

                    {{-- Actions --}}
                    <td class="px-5 py-4">
                        <div class="flex items-center justify-end gap-1.5">

                            {{-- Edit --}}
                            <a
                                href="{{ route('admin.categories.edit', $category) }}"
                                class="inline-flex h-8 w-8 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-400 hover:border-indigo-300 hover:text-indigo-600 transition-all"
                                title="Edit"
                            >
                                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z"/>
                                </svg>
                            </a>

                            {{-- Delete — standalone form, NOT inside edit --}}
                            <form
                                method="POST"
                                action="{{ route('admin.categories.destroy', $category) }}"
                                x-data
                                @submit.prevent="if(confirm('Delete category «{{ addslashes($category->name) }}»?\nThis cannot be undone.')) $el.submit()"
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
                    <td colspan="7" class="px-5 py-16 text-center">
                        <div class="flex flex-col items-center gap-3 text-slate-400">
                            <svg class="h-10 w-10 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.2" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z"/>
                            </svg>
                            <p class="text-sm font-medium">No categories found</p>
                            <a
                                href="{{ route('admin.categories.create') }}"
                                class="text-xs font-semibold text-indigo-600 hover:text-indigo-800 transition-colors"
                            >
                                Create your first category →
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse

            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if ($categories->hasPages())
    <div class="border-t border-slate-100 bg-slate-50/60 px-5 py-3.5">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <p class="text-xs text-slate-500">
                Showing
                <span class="font-medium text-slate-700">{{ $categories->firstItem() }}</span>–<span class="font-medium text-slate-700">{{ $categories->lastItem() }}</span>
                of <span class="font-medium text-slate-700">{{ $categories->total() }}</span> categories
            </p>
            {{ $categories->withQueryString()->links('pagination::tailwind') }}
        </div>
    </div>
    @endif

</div>

@endsection