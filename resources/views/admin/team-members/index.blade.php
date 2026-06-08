@extends('layouts.admin')

@section('title','Team Members')

@section('breadcrumb')
    <span class="text-slate-300">/</span>
    <span class="text-slate-500">All Team Members</span>
@endsection

@section('content')

{{-- ── PAGE HEADER ─────────────────────────────────────────── --}}
<div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div>
        <h2 class="text-xl font-bold text-slate-800 font-display">Team Members</h2>
        <p class="mt-0.5 text-sm text-slate-500">Manage the people displayed on your public team page.</p>
    </div>
    <a
        href="{{ route('admin.team-members.create') }}"
        class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 active:bg-indigo-800 transition-colors"
    >
        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
        </svg>
        Add Member
    </a>
</div>
 
{{-- ── STATS STRIP ─────────────────────────────────────────── --}}
<div class="mb-5 grid grid-cols-2 sm:grid-cols-3 gap-3">
    @php
        $totalCount  = $members->total();
        $activeCount = \App\Models\TeamMember::where('status', true)->count();
        $hiddenCount = \App\Models\TeamMember::where('status', false)->count();
    @endphp
    @foreach ([
        ['Total Members', $totalCount,   'text-slate-700',   'bg-slate-100'],
        ['Visible',       $activeCount, 'text-emerald-700', 'bg-emerald-100'],
        ['Hidden',        $hiddenCount, 'text-slate-600',   'bg-slate-100'],
    ] as [$label, $count, $text, $bg])
    <div class="rounded-xl border border-slate-200 bg-white px-4 py-3">
        <p class="text-xs text-slate-500 mb-1">{{ $label }}</p>
        <p class="text-2xl font-semibold font-display text-slate-800">{{ $count }}</p>
    </div>
    @endforeach
</div>

{{-- ── ALPINES SCOPE WRAPPER (Shares view state across control buttons and displays) ── --}}
<div x-data="{ view: 'grid' }">
 
    {{-- ── VIEW TOGGLE + SEARCH ─────────────────────────────────── --}}
    <div class="mb-5 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
     
        <form method="GET" action="{{ route('admin.team-members.index') }}" class="flex items-center gap-2">
            <div class="relative max-w-xs flex-1">
                <svg class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/>
                </svg>
                <input
                    type="search" name="search" value="{{ request('search') }}"
                    placeholder="Search members…"
                    class="w-full rounded-xl border border-slate-200 bg-white py-2.5 pl-9 pr-4 text-sm text-slate-700 placeholder-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-100 transition"
                />
            </div>
            <select name="status" onchange="this.form.submit()" class="rounded-xl border border-slate-200 bg-white py-2.5 pl-3 pr-8 text-sm text-slate-600 focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-100 transition">
                <option value="">All Statuses</option>
                <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Visible</option>
                <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Hidden</option>
            </select>
            @if (request()->hasAny(['search','status']))
                <a href="{{ route('admin.team-members.index') }}" class="rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-xs font-medium text-slate-500 hover:text-slate-700 transition">Clear</a>
            @endif
        </form>
     
        {{-- View toggle buttons --}}
        <div class="flex items-center gap-1 rounded-xl border border-slate-200 bg-white p-1">
            <button type="button" @click="view = 'grid'"
                :class="view === 'grid' ? 'bg-indigo-600 text-white shadow-sm' : 'text-slate-400 hover:text-slate-600'"
                class="flex h-8 w-8 items-center justify-center rounded-lg transition-all" title="Grid view">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z"/>
                </svg>
            </button>
            <button type="button" @click="view = 'list'"
                :class="view === 'list' ? 'bg-indigo-600 text-white shadow-sm' : 'text-slate-400 hover:text-slate-600'"
                class="flex h-8 w-8 items-center justify-center rounded-lg transition-all" title="List view">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zM3.75 12h.007v.008H3.75V12zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm-.375 5.25h.007v.008H3.75v-.008zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/>
                </svg>
            </button>
        </div>
     
    </div>
     
    {{-- ═══════════════════════════════════════════════════════════
         GRID VIEW PANEL
    ═══════════════════════════════════════════════════════════ --}}
    <div x-show="view === 'grid'" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
        @forelse ($members as $member)
        <div class="group relative rounded-2xl border border-slate-200 bg-white overflow-hidden hover:border-indigo-200 hover:shadow-md transition-all duration-200">
 
            {{-- Status indicator strip --}}
            <div class="absolute top-0 inset-x-0 h-0.5 {{ $member->status ? 'bg-emerald-400' : 'bg-slate-300' }}"></div>
 
            {{-- Member photo --}}
            <div class="relative h-48 bg-gradient-to-br from-slate-100 to-slate-200 overflow-hidden">
                @if ($member->image)
                    <img
                        src="{{ Storage::url($member->image) }}"
                        alt="{{ $member->name }}"
                        class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105"
                    />
                @else
                    <div class="flex h-full w-full items-center justify-center bg-gradient-to-br from-indigo-50 to-slate-100">
                        <div class="flex h-20 w-20 items-center justify-center rounded-full bg-indigo-100 text-3xl font-bold text-indigo-500 font-display">
                            {{ strtoupper(substr($member->name, 0, 1)) }}
                        </div>
                    </div>
                @endif
 
                {{-- Hover action overlay --}}
                <div class="absolute inset-0 flex items-center justify-center gap-2 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity">
                    <a href="{{ route('admin.team-members.edit', $member) }}"
                        class="flex h-9 w-9 items-center justify-center rounded-xl bg-white/90 text-slate-700 hover:bg-white transition-colors shadow"
                        title="Edit">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z"/></svg>
                    </a>
                    <form method="POST" action="{{ route('admin.team-members.destroy', $member) }}"
                        x-data @submit.prevent="if(confirm('Remove {{ addslashes($member->name) }} from the team?')) $el.submit()">
                        @csrf @method('DELETE')
                        <button type="submit"
                            class="flex h-9 w-9 items-center justify-center rounded-xl bg-white/90 text-red-600 hover:bg-red-600 hover:text-white transition-colors shadow"
                            title="Delete">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
                        </button>
                    </form>
                </div>
            </div>
 
            {{-- Member info --}}
            <div class="p-4">
                <div class="flex items-start justify-between gap-2 mb-2">
                    <div class="min-w-0">
                        <h3 class="text-sm font-semibold text-slate-800 truncate">{{ $member->name }}</h3>
                        <p class="text-xs text-indigo-600 font-medium truncate mt-0.5">{{ $member->designation }}</p>
                    </div>
                    {{-- Status badge --}}
                    @if ($member->status)
                        <span class="flex-shrink-0 inline-flex items-center gap-1 rounded-full bg-emerald-100 px-2 py-0.5 text-[10px] font-semibold text-emerald-700">
                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>On
                        </span>
                    @else
                        <span class="flex-shrink-0 inline-flex items-center gap-1 rounded-full bg-slate-100 px-2 py-0.5 text-[10px] font-semibold text-slate-500">
                            <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span>Off
                        </span>
                    @endif
                </div>
 
                {{-- Bio snippet --}}
                @if ($member->bio)
                <p class="text-xs text-slate-500 leading-relaxed line-clamp-2 mb-3">{{ Str::limit($member->bio, 80) }}</p>
                @endif
 
                {{-- Social links --}}
                <div class="flex items-center gap-2">
                    @if ($member->linkedin)
                    <a href="{{ $member->linkedin }}" target="_blank"
                        class="flex h-7 w-7 items-center justify-center rounded-lg border border-slate-200 bg-slate-50 text-slate-500 hover:border-blue-300 hover:bg-blue-50 hover:text-blue-600 transition-all"
                        title="LinkedIn">
                        <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                    </a>
                    @endif
                    @if ($member->facebook)
                    <a href="{{ $member->facebook }}" target="_blank"
                        class="flex h-7 w-7 items-center justify-center rounded-lg border border-slate-200 bg-slate-50 text-slate-500 hover:border-blue-400 hover:bg-blue-50 hover:text-blue-700 transition-all"
                        title="Facebook">
                        <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"/></svg>
                    </a>
                    @endif
 
                    <a href="{{ route('admin.team-members.edit', $member) }}"
                        class="ml-auto flex h-7 items-center gap-1 rounded-lg border border-slate-200 bg-slate-50 px-2.5 text-[11px] font-medium text-slate-500 hover:border-indigo-300 hover:bg-indigo-50 hover:text-indigo-700 transition-all">
                        <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z"/></svg>
                        Edit
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full py-16 text-center">
            <div class="flex flex-col items-center gap-3 text-slate-400">
                <svg class="h-12 w-12 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.2" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/>
                </svg>
                <p class="text-sm font-medium">No team members found</p>
                <a href="{{ route('admin.team-members.create') }}" class="text-xs font-semibold text-indigo-600 hover:text-indigo-800 transition-colors">Add your first team member →</a>
            </div>
        </div>
        @endforelse
    </div>
 
    {{-- ═══════════════════════════════════════════════════════════
         LIST VIEW PANEL
    ═══════════════════════════════════════════════════════════ --}}
    <div x-show="view === 'list'" class="rounded-2xl border border-slate-200 bg-white overflow-hidden" x-cloak>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-100">
                <thead>
                    <tr class="bg-slate-50/80">
                        <th scope="col" class="px-5 py-3.5 text-left text-[11px] font-semibold uppercase tracking-wider text-slate-500 w-[35%]">Member</th>
                        <th scope="col" class="px-5 py-3.5 text-left text-[11px] font-semibold uppercase tracking-wider text-slate-500">Designation</th>
                        <th scope="col" class="px-5 py-3.5 text-left text-[11px] font-semibold uppercase tracking-wider text-slate-500">Social</th>
                        <th scope="col" class="px-5 py-3.5 text-left text-[11px] font-semibold uppercase tracking-wider text-slate-500">Order</th>
                        <th scope="col" class="px-5 py-3.5 text-left text-[11px] font-semibold uppercase tracking-wider text-slate-500">Status</th>
                        <th scope="col" class="px-5 py-3.5 text-right text-[11px] font-semibold uppercase tracking-wider text-slate-500">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($members as $member)
                    <tr class="group hover:bg-slate-50/60 transition-colors">
                        <td class="px-5 py-4">
                            <div class="flex items-center gap-3">
                                <div class="h-10 w-10 flex-shrink-0 overflow-hidden rounded-xl bg-indigo-50">
                                    @if ($member->image)
                                        <img src="{{ Storage::url($member->image) }}" alt="{{ $member->name }}" class="h-full w-full object-cover"/>
                                    @else
                                        <div class="flex h-full w-full items-center justify-center text-sm font-bold text-indigo-500">{{ strtoupper(substr($member->name, 0, 1)) }}</div>
                                    @endif
                                </div>
                                <div class="min-w-0">
                                    <p class="text-sm font-semibold text-slate-700 truncate">{{ $member->name }}</p>
                                    @if ($member->bio)
                                    <p class="text-xs text-slate-400 truncate max-w-[160px]">{{ Str::limit($member->bio, 45) }}</p>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-4">
                            <span class="inline-flex rounded-lg bg-indigo-50 px-2.5 py-1 text-xs font-medium text-indigo-700">{{ $member->designation }}</span>
                        </td>
                        <td class="px-5 py-4">
                            <div class="flex items-center gap-2">
                                @if ($member->linkedin)
                                <a href="{{ $member->linkedin }}" target="_blank" title="LinkedIn" class="text-slate-400 hover:text-blue-600 transition-colors">
                                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452z"/></svg>
                                </a>
                                @endif
                                @if ($member->facebook)
                                <a href="{{ $member->facebook }}" target="_blank" title="Facebook" class="text-slate-400 hover:text-blue-700 transition-colors">
                                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"/></svg>
                                </a>
                                @endif
                                @if (!$member->linkedin && !$member->facebook)
                                    <span class="text-xs text-slate-400">—</span>
                                @endif
                            </div>
                        </td>
                        <td class="px-5 py-4 text-sm text-slate-500 font-mono">{{ $member->sort_order }}</td>
                        <td class="px-5 py-4">
                            @if ($member->status)
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-100 px-2.5 py-0.5 text-[11px] font-semibold text-emerald-700">
                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>Visible
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-slate-100 px-2.5 py-0.5 text-[11px] font-semibold text-slate-500">
                                    <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span>Hidden
                                </span>
                            @endif
                        </td>
                        <td class="px-5 py-4">
                            <div class="flex items-center justify-end gap-1.5">
                                <a href="{{ route('admin.team-members.edit', $member) }}"
                                    class="inline-flex h-8 w-8 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-400 hover:border-indigo-300 hover:text-indigo-600 transition-all" title="Edit">
                                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z"/></svg>
                                </a>
                                <form method="POST" action="{{ route('admin.team-members.destroy', $member) }}"
                                    x-data @submit.prevent="if(confirm('Remove {{ addslashes($member->name) }}?')) $el.submit()">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="inline-flex h-8 w-8 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-400 hover:border-red-200 hover:bg-red-50 hover:text-red-600 transition-all" title="Delete">
                                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="py-16 text-center text-sm text-slate-400">No team members found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Pagination --}}
@if ($members->hasPages())
<div class="mt-5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
    <p class="text-xs text-slate-500">
        Showing <span class="font-medium text-slate-700">{{ $members->firstItem() }}</span>–<span class="font-medium text-slate-700">{{ $members->lastItem() }}</span>
        of <span class="font-medium text-slate-700">{{ $members->total() }}</span> members
    </p>
    {{ $members->withQueryString()->links('pagination::tailwind') }}
</div>
@endif
 
@endsection