
@extends('layouts.admin')

@section('title', $project->title)
@section('page-title', 'Projects')

@section('breadcrumb')
    <span class="text-slate-300">/</span>
    <a href="{{ route('admin.projects.index') }}" class="hover:text-indigo-600 transition-colors">All Projects</a>
    <span class="text-slate-300">/</span>
    <span class="text-slate-500 truncate max-w-[180px]">{{ Str::limit($project->title, 30) }}</span>
@endsection

@section('content')

{{-- ── PAGE HEADER ─────────────────────────────────────────── --}}
<div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.projects.index') }}"
            class="flex h-9 w-9 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-400 hover:border-slate-300 hover:text-slate-700 transition-all">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
        </a>
        <div>
            <h2 class="text-xl font-bold text-slate-800 font-display">Project Detail</h2>
            <p class="mt-0.5 text-sm text-slate-500">Read-only overview of this project</p>
        </div>
    </div>
    <div class="flex items-center gap-2 flex-shrink-0">
        @if ($project->status === 'active' && $project->project_url)
        <a href="{{ $project->project_url }}" target="_blank"
            class="inline-flex items-center gap-1.5 rounded-xl border border-slate-200 bg-white px-3.5 py-2.5 text-sm font-medium text-slate-600 hover:border-slate-300 hover:text-slate-800 transition-colors">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
            View Live
        </a>
        @endif
        <a href="{{ route('admin.projects.edit', $project) }}"
            class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-indigo-700 active:bg-indigo-800 transition-colors">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z"/></svg>
            Edit Project
        </a>
    </div>
</div>

<div class="grid grid-cols-1 xl:grid-cols-3 gap-5">

    {{-- ══════════════════════════════════════════
         LEFT — Project Content (2/3)
    ══════════════════════════════════════════ --}}
    <div class="xl:col-span-2 space-y-5">

        {{-- Hero / Featured Image --}}
        @if ($project->featured_image)
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white">
            <img src="{{ Storage::url($project->featured_image) }}" alt="{{ $project->title }}"
                class="h-72 w-full object-cover"/>
        </div>
        @endif

        {{-- Title + Meta strip --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-6">
            {{-- Badges --}}
            <div class="mb-4 flex flex-wrap items-center gap-2">
                @if ($project->status === 'active')
                    <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-100 px-2.5 py-0.5 text-[11px] font-semibold text-emerald-700">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>Active
                    </span>
                @else
                    <span class="inline-flex items-center gap-1.5 rounded-full bg-slate-100 px-2.5 py-0.5 text-[11px] font-semibold text-slate-500">
                        <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span>Inactive
                    </span>
                @endif

                @if ($project->is_featured)
                <span class="inline-flex items-center gap-1 rounded-full bg-amber-100 px-2.5 py-0.5 text-[11px] font-semibold text-amber-700">
                    <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    Featured
                </span>
                @endif

                @if ($project->category)
                <span class="inline-flex rounded-full bg-indigo-50 px-2.5 py-0.5 text-[11px] font-semibold text-indigo-700">{{ $project->category->name }}</span>
                @endif
            </div>

            {{-- Title --}}
            <h1 class="text-2xl font-bold text-slate-800 font-display mb-4 leading-snug">{{ $project->title }}</h1>

            {{-- Client + URL --}}
            <div class="flex flex-wrap items-center gap-4 pb-5 border-b border-slate-100">
                @if ($project->client_name)
                <div class="flex items-center gap-2">
                    <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0"/></svg>
                    <span class="text-sm text-slate-600 font-medium">{{ $project->client_name }}</span>
                </div>
                @endif

                @if ($project->completion_date)
                <div class="flex items-center gap-2">
                    <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5"/></svg>
                    <span class="text-sm text-slate-600">Completed {{ \Carbon\Carbon::parse($project->completion_date)->format('F Y') }}</span>
                </div>
                @endif

                @if ($project->project_url)
                <a href="{{ $project->project_url }}" target="_blank"
                    class="flex items-center gap-1.5 text-sm text-indigo-600 hover:text-indigo-800 transition-colors">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                    {{ parse_url($project->project_url, PHP_URL_HOST) ?? $project->project_url }}
                </a>
                @endif
            </div>

            {{-- Description --}}
            <div class="mt-5 prose prose-sm prose-slate max-w-none
                prose-headings:font-bold prose-headings:text-slate-800
                prose-p:text-slate-600 prose-p:leading-relaxed
                prose-a:text-indigo-600 prose-a:no-underline hover:prose-a:underline">
                {!! nl2br(e($project->description)) !!}
            </div>
        </div>

        {{-- Gallery --}}
        @if ($project->images->isNotEmpty())
        <div class="rounded-2xl border border-slate-200 bg-white p-6">
            <div class="mb-4 flex items-center justify-between">
                <h3 class="text-sm font-semibold text-slate-700">
                    Project Gallery
                    <span class="ml-2 inline-flex items-center rounded-full bg-slate-100 px-2 py-0.5 text-[11px] font-medium text-slate-600">
                        {{ $project->images->count() }} images
                    </span>
                </h3>
            </div>

            {{-- Gallery grid --}}
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3" x-data="{ lightbox: false, current: null }">
                @foreach ($project->images->sortBy('sort_order') as $img)
                <div
                    class="group relative overflow-hidden rounded-xl cursor-pointer"
                    @click="current = '{{ Storage::url($img->image) }}'; lightbox = true"
                >
                    <img
                        src="{{ Storage::url($img->image) }}"
                        alt="Gallery image {{ $loop->iteration }}"
                        class="h-40 w-full object-cover transition-transform duration-300 group-hover:scale-105"
                        loading="lazy"
                    />
                    <div class="absolute inset-0 flex items-center justify-center bg-black/30 opacity-0 group-hover:opacity-100 transition-opacity">
                        <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607zM10.5 7.5v6m3-3h-6"/>
                        </svg>
                    </div>
                </div>
                @endforeach

                {{-- Lightbox modal --}}
                <div
                    x-show="lightbox"
                    x-transition:enter="transition-opacity duration-200"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="transition-opacity duration-150"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    @click="lightbox = false"
                    @keydown.escape.window="lightbox = false"
                    class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 p-4"
                    style="display:none"
                >
                    <div @click.stop class="relative max-h-[85vh] max-w-4xl">
                        <img :src="current" alt="Full size" class="max-h-[85vh] w-auto rounded-xl object-contain shadow-2xl"/>
                        <button @click="lightbox = false"
                            class="absolute -top-3 -right-3 flex h-8 w-8 items-center justify-center rounded-full bg-white text-slate-700 shadow-lg hover:bg-slate-100 transition-colors">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endif

    </div>

    {{-- ══════════════════════════════════════════
         RIGHT — Meta Sidebar (1/3)
    ══════════════════════════════════════════ --}}
    <div class="space-y-5">

        {{-- Project Details --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-5">
            <h3 class="mb-4 text-sm font-semibold text-slate-700">Project Details</h3>
            <dl class="space-y-3">
                @foreach ([
                    ['Status',   ucfirst($project->status)],
                    ['Featured', $project->is_featured ? 'Yes' : 'No'],
                    ['Category', $project->category->name ?? '—'],
                    ['Client',   $project->client_name ?? '—'],
                    ['Slug',     $project->slug],
                    ['Completed',$project->completion_date ? \Carbon\Carbon::parse($project->completion_date)->format('M Y') : '—'],
                    ['Gallery',  $project->images->count() . ' image(s)'],
                    ['Created',  $project->created_at->format('M j, Y')],
                    ['Updated',  $project->updated_at->format('M j, Y')],
                ] as [$key, $val])
                <div class="flex items-start justify-between gap-2">
                    <dt class="text-xs font-medium text-slate-500 flex-shrink-0 w-20">{{ $key }}</dt>
                    <dd class="text-xs text-slate-700 text-right break-all">{{ $val }}</dd>
                </div>
                @endforeach
            </dl>
        </div>

        {{-- Featured Image thumbnail --}}
        @if ($project->featured_image)
        <div class="rounded-2xl border border-slate-200 bg-white p-5">
            <h3 class="mb-3 text-sm font-semibold text-slate-700">Featured Image</h3>
            <a href="{{ Storage::url($project->featured_image) }}" target="_blank" class="block group">
                <img src="{{ Storage::url($project->featured_image) }}" alt="Featured image" class="h-36 w-full rounded-xl object-cover group-hover:opacity-90 transition-opacity"/>
                <p class="mt-2 text-[11px] text-indigo-600 text-center hover:underline">Open full size →</p>
            </a>
        </div>
        @endif

        {{-- Quick Actions --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-5">
            <h3 class="mb-3 text-sm font-semibold text-slate-700">Quick Actions</h3>
            <div class="flex flex-col gap-2">
                <a href="{{ route('admin.projects.edit', $project) }}"
                    class="flex items-center gap-2.5 rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-medium text-slate-700 hover:border-indigo-300 hover:bg-indigo-50 hover:text-indigo-700 transition-all">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z"/></svg>
                    Edit this project
                </a>

                @if ($project->project_url)
                <a href="{{ $project->project_url }}" target="_blank"
                    class="flex items-center gap-2.5 rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-medium text-slate-700 hover:border-indigo-300 hover:bg-indigo-50 hover:text-indigo-700 transition-all">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                    View live project
                </a>
                @endif

                <form method="POST" action="{{ route('admin.projects.destroy', $project) }}"
                    x-data
                    @submit.prevent="if(confirm('Permanently delete «{{ addslashes($project->title) }}»?\n\nAll images will also be deleted.')) $el.submit()">
                    @csrf @method('DELETE')
                    <button type="submit"
                        class="flex w-full items-center gap-2.5 rounded-xl border border-red-200 bg-red-50 px-4 py-2.5 text-sm font-medium text-red-600 hover:bg-red-600 hover:text-white hover:border-red-600 transition-all">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
                        Delete project
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>

@endsection