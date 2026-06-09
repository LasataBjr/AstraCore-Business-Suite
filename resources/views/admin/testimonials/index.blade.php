@extends('layouts.admin')

@section('title', 'Testimonials')
@section('page-title', 'Testimonials')

@section('breadcrumb')
    <span class="text-slate-300">/</span>
    <span class="text-slate-500">All Testimonials</span>
@endsection

@section('content')

{{-- ── PAGE HEADER ─────────────────────────────────────────── --}}
<div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div>
        <h2 class="text-xl font-bold text-slate-800 font-display">Testimonials</h2>
        <p class="mt-0.5 text-sm text-slate-500">Manage client reviews and social proof displayed on your site.</p>
    </div>
    <a
        href="{{ route('admin.testimonials.create') }}"
        class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 active:bg-indigo-800 transition-colors"
    >
        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
        </svg>
        Add Testimonial
    </a>
</div>

{{-- ── STATS STRIP ─────────────────────────────────────────── --}}
<div class="mb-5 grid grid-cols-2 sm:grid-cols-4 gap-3">
    @php
        $totalCount   = $testimonials->total();
        $visibleCount = \App\Models\Testimonial::where('status', true)->count();
        $hiddenCount  = \App\Models\Testimonial::where('status', false)->count();
        $avgRating    = \App\Models\Testimonial::avg('rating');
    @endphp
    <div class="rounded-xl border border-slate-200 bg-white px-4 py-3">
        <p class="text-xs text-slate-500 mb-1">Total</p>
        <p class="text-2xl font-semibold font-display text-slate-800">{{ $totalCount }}</p>
    </div>
    <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3">
        <p class="text-xs text-emerald-700 mb-1">Visible</p>
        <p class="text-2xl font-semibold font-display text-slate-800">{{ $visibleCount }}</p>
    </div>
    <div class="rounded-xl border border-slate-200 bg-white px-4 py-3">
        <p class="text-xs text-slate-500 mb-1">Hidden</p>
        <p class="text-2xl font-semibold font-display text-slate-800">{{ $hiddenCount }}</p>
    </div>
    <div class="rounded-xl border border-amber-200 bg-amber-50 px-4 py-3">
        <p class="text-xs text-amber-700 mb-1">Avg Rating</p>
        <div class="flex items-center gap-1.5">
            <p class="text-2xl font-semibold font-display text-slate-800">{{ $avgRating ? number_format($avgRating, 1) : '—' }}</p>
            @if ($avgRating)
            <svg class="h-5 w-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
            </svg>
            @endif
        </div>
    </div>
</div>

{{-- ── FILTER BAR ───────────────────────────────────────────── --}}
<div class="mb-5 flex flex-wrap items-center gap-2">
    <form method="GET" action="{{ route('admin.testimonials.index') }}" class="flex flex-wrap items-center gap-2 flex-1">
        {{-- Search --}}
        <!-- <div class="relative flex-1 min-w-[180px] max-w-xs">
            <svg class="pointer-events-none absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/>
            </svg>
            <input
                type="search" name="search" value="{{ request('search') }}"
                placeholder="Search client, company…"
                class="w-full rounded-xl border border-slate-200 bg-white py-2.5 pl-9 pr-4 text-sm text-slate-700 placeholder-slate-400 focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-100 transition"
            />
        </div> -->

        {{-- Status filter --}}
        <!-- <select name="status" onchange="this.form.submit()"
            class="rounded-xl border border-slate-200 bg-white py-2.5 pl-3 pr-8 text-sm text-slate-600 focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-100 transition">
            <option value="">All Statuses</option>
            <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Visible</option>
            <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Hidden</option>
        </select> -->

        {{-- Rating filter --}}
        <select name="rating" onchange="this.form.submit()"
            class="rounded-xl border border-slate-200 bg-white py-2.5 pl-3 pr-8 text-sm text-slate-600 focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-100 transition">
            <option value="">All Ratings</option>
            @for ($i = 5; $i >= 1; $i--)
            <option value="{{ $i }}" {{ request('rating') == $i ? 'selected' : '' }}>{{ $i }} ★</option>
            @endfor
        </select>

        @if (request()->hasAny(['search','status','rating']))
            <a href="{{ route('admin.testimonials.index') }}" class="rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-xs font-medium text-slate-500 hover:text-slate-700 transition">Clear</a>
        @endif
    </form>
</div>

{{-- ── TABLE ───────────────────────────────────────────────── --}}
<div class="rounded-2xl border border-slate-200 bg-white overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-100">
            <thead>
                <tr class="bg-slate-50/80">
                    <th scope="col" class="px-5 py-3.5 text-left text-[11px] font-semibold uppercase tracking-wider text-slate-500 w-[30%]">Client</th>
                    <th scope="col" class="px-5 py-3.5 text-left text-[11px] font-semibold uppercase tracking-wider text-slate-500">Rating</th>
                    <th scope="col" class="px-5 py-3.5 text-left text-[11px] font-semibold uppercase tracking-wider text-slate-500 w-[35%]">Review</th>
                    <th scope="col" class="px-5 py-3.5 text-left text-[11px] font-semibold uppercase tracking-wider text-slate-500">Status</th>
                    <th scope="col" class="px-5 py-3.5 text-left text-[11px] font-semibold uppercase tracking-wider text-slate-500">Date</th>
                    <th scope="col" class="px-5 py-3.5 text-right text-[11px] font-semibold uppercase tracking-wider text-slate-500">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">

                @forelse ($testimonials as $testimonial)
                <tr class="group hover:bg-slate-50/60 transition-colors">

                    {{-- Client info --}}
                    <td class="px-5 py-4">
                        <div class="flex items-center gap-3">
                            {{-- Photo --}}
                            <div class="h-10 w-10 flex-shrink-0 overflow-hidden rounded-full border-2 border-slate-100 bg-slate-50">
                                @if ($testimonial->image)
                                    <img src="{{ Storage::url($testimonial->image) }}" alt="{{ $testimonial->client_name }}" class="h-full w-full object-cover"/>
                                @else
                                    <div class="flex h-full w-full items-center justify-center text-sm font-bold text-indigo-500 bg-indigo-50">
                                        {{ strtoupper(substr($testimonial->client_name, 0, 1)) }}
                                    </div>
                                @endif
                            </div>
                            <div class="min-w-0">
                                <p class="text-sm font-semibold text-slate-700 truncate">{{ $testimonial->client_name }}</p>
                                @if ($testimonial->designation || $testimonial->company)
                                <p class="text-xs text-slate-400 truncate">
                                    {{ implode(', ', array_filter([$testimonial->designation, $testimonial->company])) }}
                                </p>
                                @endif
                            </div>
                        </div>
                    </td>

                    {{-- Star rating --}}
                    <td class="px-5 py-4">
                        <div class="flex items-center gap-0.5">
                            @for ($i = 1; $i <= 5; $i++)
                            <svg class="h-4 w-4 {{ $i <= $testimonial->rating ? 'text-amber-400' : 'text-slate-200' }}"
                                fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            @endfor
                        </div>
                        <span class="mt-0.5 text-[11px] text-slate-400">{{ $testimonial->rating }}/5</span>
                    </td>

                    {{-- Review snippet --}}
                    <td class="px-5 py-4">
                        <p class="text-sm text-slate-600 leading-relaxed line-clamp-2">
                            "{{ Str::limit($testimonial->review, 100) }}"
                        </p>
                    </td>

                    {{-- Status --}}
                    <td class="px-5 py-4">
                        @if ($testimonial->status)
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-100 px-2.5 py-0.5 text-[11px] font-semibold text-emerald-700">
                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>Visible
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-slate-100 px-2.5 py-0.5 text-[11px] font-semibold text-slate-500">
                                <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span>Hidden
                            </span>
                        @endif
                    </td>

                    {{-- Date --}}
                    <td class="px-5 py-4 text-xs text-slate-400 whitespace-nowrap">
                        {{ $testimonial->created_at->format('M j, Y') }}
                    </td>

                    {{-- Actions --}}
                    <td class="px-5 py-4">
                        <div class="flex items-center justify-end gap-1.5">
                            <a href="{{ route('admin.testimonials.edit', $testimonial) }}"
                                class="inline-flex h-8 w-8 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-400 hover:border-indigo-300 hover:text-indigo-600 transition-all" title="Edit">
                                <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z"/></svg>
                            </a>
                            <form method="POST" action="{{ route('admin.testimonials.destroy', $testimonial) }}"
                                x-data @submit.prevent="if(confirm('Delete testimonial from {{ addslashes($testimonial->client_name) }}?')) $el.submit()">
                                @csrf @method('DELETE')
                                <button type="submit"
                                    class="inline-flex h-8 w-8 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-400 hover:border-red-200 hover:bg-red-50 hover:text-red-600 transition-all" title="Delete">
                                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>

                @empty
                <tr>
                    <td colspan="6" class="px-5 py-16 text-center">
                        <div class="flex flex-col items-center gap-3 text-slate-400">
                            <svg class="h-12 w-12 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.2" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z"/>
                            </svg>
                            <p class="text-sm font-medium">No testimonials yet</p>
                            <a href="{{ route('admin.testimonials.create') }}" class="text-xs font-semibold text-indigo-600 hover:text-indigo-800 transition-colors">Add your first testimonial →</a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if ($testimonials->hasPages())
    <div class="border-t border-slate-100 bg-slate-50/60 px-5 py-3.5">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <p class="text-xs text-slate-500">
                Showing <span class="font-medium text-slate-700">{{ $testimonials->firstItem() }}</span>–<span class="font-medium text-slate-700">{{ $testimonials->lastItem() }}</span>
                of <span class="font-medium text-slate-700">{{ $testimonials->total() }}</span> testimonials
            </p>
            {{ $testimonials->withQueryString()->links('pagination::tailwind') }}
        </div>
    </div>
    @endif
</div>

@endsection