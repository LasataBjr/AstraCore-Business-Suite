
@extends('layouts.admin')

@section('title', 'Projects')
@section('page-title', 'Projects')

@section('breadcrumb')
    <span class="text-slate-300">/</span>
    <span class="text-slate-500">All Projects</span>
@endsection

@section('content')

{{-- ── PAGE HEADER ─────────────────────────────────────────── --}}
<div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div>
        <h2 class="text-xl font-bold text-slate-800 font-display">Projects</h2>
        <p class="mt-0.5 text-sm text-slate-500">Showcase your work and portfolio pieces.</p>
    </div>
    <a
        href="{{ route('admin.projects.create') }}"
        class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 active:bg-indigo-800 transition-colors"
    >
        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
        </svg>
        New Project
    </a>
</div>

{{-- ── STATS STRIP ─────────────────────────────────────────── --}}
<div class="mb-5 grid grid-cols-2 sm:grid-cols-4 gap-3">
    @php
        $totalCount    = $projects->total();
        $activeCount   = \App\Models\Project::where('status','active')->count();
        $inactiveCount = \App\Models\Project::where('status','inactive')->count();
        $featuredCount = \App\Models\Project::where('is_featured', true)->count();
    @endphp
    @foreach ([
        ['Total',    $totalCount,    'text-slate-700',   'bg-slate-100'],
        ['Active',   $activeCount,   'text-emerald-700', 'bg-emerald-100'],
        ['Inactive', $inactiveCount, 'text-slate-600',   'bg-slate-100'],
        ['Featured', $featuredCount, 'text-amber-700',   'bg-amber-100'],
    ] as [$label, $count, $text, $bg])
    <div class="rounded-xl border border-slate-200 bg-white px-4 py-3">
        <p class="text-xs text-slate-500 mb-1">{{ $label }}</p>
        <p class="text-2xl font-semibold font-display text-slate-800">{{ $count }}</p>
    </div>
    @endforeach
</div>

{{-- ── SEARCH + FILTER ─────────────────────────────────────── --}}
<div class="mb-4">
    <form method="GET" action="{{ route('admin.projects.index') }}" class="flex flex-wrap items-center gap-2">
        <div class="relative flex-1 min-w-[180px] max-w-xs">
            <svg class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/>
            </svg>
            <input
                type="search" name="search" value="{{ request('search') }}"
                placeholder="Search projects…"
                class="w-full rounded-xl border border-slate-200 bg-white py-2.5 pl-9 pr-4 text-sm text-slate-700 placeholder-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-100 transition"
            />
        </div>
        <select name="status" onchange="this.form.submit()" class="rounded-xl border border-slate-200 bg-white py-2.5 pl-3 pr-8 text-sm text-slate-600 focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-100 transition">
            <option value="">All Statuses</option>
            <option value="active"   {{ request('status') === 'active'   ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
        </select>
        <select name="featured" onchange="this.form.submit()" class="rounded-xl border border-slate-200 bg-white py-2.5 pl-3 pr-8 text-sm text-slate-600 focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-100 transition">
            <option value="">All Projects</option>
            <option value="1" {{ request('featured') === '1' ? 'selected' : '' }}>Featured Only</option>
        </select>
        @if (request()->hasAny(['search','status','featured']))
            <a href="{{ route('admin.projects.index') }}" class="rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-xs font-medium text-slate-500 hover:text-slate-700 transition">Clear</a>
        @endif
    </form>
</div>

{{-- ── TABLE ───────────────────────────────────────────────── --}}
<div class="rounded-2xl border border-slate-200 bg-white overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-100">
            <thead>
                <tr class="bg-slate-50/80">
                    <th scope="col" class="px-5 py-3.5 text-left text-[11px] font-semibold uppercase tracking-wider text-slate-500 w-[32%]">Project</th>
                    <th scope="col" class="px-5 py-3.5 text-left text-[11px] font-semibold uppercase tracking-wider text-slate-500">Category</th>
                    <th scope="col" class="px-5 py-3.5 text-left text-[11px] font-semibold uppercase tracking-wider text-slate-500">Client</th>
                    <th scope="col" class="px-5 py-3.5 text-left text-[11px] font-semibold uppercase tracking-wider text-slate-500">Featured</th>
                    <th scope="col" class="px-5 py-3.5 text-left text-[11px] font-semibold uppercase tracking-wider text-slate-500">Status</th>
                    <th scope="col" class="px-5 py-3.5 text-left text-[11px] font-semibold uppercase tracking-wider text-slate-500">Completed</th>
                    <th scope="col" class="px-5 py-3.5 text-right text-[11px] font-semibold uppercase tracking-wider text-slate-500">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">

                @forelse ($projects as $project)
                <tr class="group hover:bg-slate-50/60 transition-colors">

                    {{-- Project thumbnail + title --}}
                    <td class="px-5 py-4">
                        <div class="flex items-center gap-3">
                            <div class="h-12 w-16 flex-shrink-0 overflow-hidden rounded-lg bg-slate-100">
                                @if ($project->featured_image)
                                    <img src="{{ Storage::url($project->featured_image) }}" alt="{{ $project->title }}" class="h-full w-full object-cover"/>
                                @else
                                    <div class="flex h-full w-full items-center justify-center">
                                        <svg class="h-5 w-5 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="min-w-0">
                                <p class="text-sm font-semibold text-slate-700 truncate max-w-[180px]">{{ $project->title }}</p>
                                <p class="mt-0.5 font-mono text-[10px] text-slate-400 truncate max-w-[180px]">{{ $project->slug }}</p>
                            </div>
                        </div>
                    </td>

                    {{-- Category --}}
                    <td class="px-5 py-4">
                        @if ($project->category)
                            <span class="inline-flex items-center rounded-lg bg-indigo-50 px-2.5 py-1 text-xs font-medium text-indigo-700">{{ $project->category->name }}</span>
                        @else
                            <span class="text-xs text-slate-400">—</span>
                        @endif
                    </td>

                    {{-- Client --}}
                    <td class="px-5 py-4 text-sm text-slate-500">{{ $project->client_name ?? '—' }}</td>

                    {{-- Featured --}}
                    <td class="px-5 py-4">
                        @if ($project->is_featured)
                            <span class="inline-flex items-center gap-1 rounded-full bg-amber-100 px-2.5 py-0.5 text-[11px] font-semibold text-amber-700">
                                <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                Featured
                            </span>
                        @else
                            <span class="text-xs text-slate-400">—</span>
                        @endif
                    </td>

                    {{-- Status --}}
                    <td class="px-5 py-4">
                        @if ($project->status === 'active')
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-100 px-2.5 py-0.5 text-[11px] font-semibold text-emerald-700">
                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>Active
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-slate-100 px-2.5 py-0.5 text-[11px] font-semibold text-slate-500">
                                <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span>Inactive
                            </span>
                        @endif
                    </td>

                    {{-- Completion date --}}
                    <td class="px-5 py-4 text-xs text-slate-400 whitespace-nowrap">
                        {{ $project->completion_date ? \Carbon\Carbon::parse($project->completion_date)->format('M Y') : '—' }}
                    </td>

                    {{-- Actions --}}
                    <td class="px-5 py-4">
                        <div class="flex items-center justify-end gap-1.5">
                            <a href="{{ route('admin.projects.show', $project) }}"
                                class="inline-flex h-8 w-8 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-400 hover:border-slate-300 hover:text-slate-700 transition-all" title="View">
                                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </a>
                            <a href="{{ route('admin.projects.edit', $project) }}"
                                class="inline-flex h-8 w-8 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-400 hover:border-indigo-300 hover:text-indigo-600 transition-all" title="Edit">
                                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z"/></svg>
                            </a>
                            <form method="POST" action="{{ route('admin.projects.destroy', $project) }}" x-data @submit.prevent="if(confirm('Delete «{{ addslashes($project->title) }}»? All images will also be deleted.')) $el.submit()">
                                @csrf @method('DELETE')
                                <button type="submit" class="inline-flex h-8 w-8 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-400 hover:border-red-200 hover:bg-red-50 hover:text-red-600 transition-all" title="Delete">
                                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
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
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.429 9.75L2.25 12l4.179 2.25m0-4.5l5.571 3 5.571-3m-11.142 0L2.25 7.5 12 2.25l9.75 5.25-4.179 2.25m0 0L21.75 12l-4.179 2.25m0 0l4.179 2.25L12 21.75 2.25 16.5l4.179-2.25m11.142 0l-5.571 3-5.571-3"/>
                            </svg>
                            <p class="text-sm font-medium">No projects found</p>
                            <a href="{{ route('admin.projects.create') }}" class="text-xs font-semibold text-indigo-600 hover:text-indigo-800 transition-colors">Add your first project →</a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($projects->hasPages())
    <div class="border-t border-slate-100 bg-slate-50/60 px-5 py-3.5">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <p class="text-xs text-slate-500">
                Showing <span class="font-medium text-slate-700">{{ $projects->firstItem() }}</span>–<span class="font-medium text-slate-700">{{ $projects->lastItem() }}</span>
                of <span class="font-medium text-slate-700">{{ $projects->total() }}</span> projects
            </p>
            {{ $projects->withQueryString()->links('pagination::tailwind') }}
        </div>
    </div>
    @endif
</div>

@endsection