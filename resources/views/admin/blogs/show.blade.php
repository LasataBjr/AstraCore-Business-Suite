@extends('layouts.admin')
 
@section('title', $blog->title)
@section('page-title', 'Blog Posts')
 
@section('breadcrumb')
    <span class="text-slate-300">/</span>
    <a href="{{ route('admin.blogs.index') }}" class="hover:text-indigo-600 transition-colors">All Posts</a>
    <span class="text-slate-300">/</span>
    <span class="text-slate-500 truncate max-w-[180px]">{{ Str::limit($blog->title, 35) }}</span>
@endsection
 
@section('content')
 
{{-- ── PAGE HEADER ─────────────────────────────────────────── --}}
<div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div class="flex items-center gap-3">
        <a
            href="{{ route('admin.blogs.index') }}"
            class="flex h-9 w-9 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-400 hover:border-slate-300 hover:text-slate-700 transition-all"
        >
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/>
            </svg>
        </a>
        <div>
            <h2 class="text-xl font-bold text-slate-800 font-display">Post Detail</h2>
            <p class="mt-0.5 text-sm text-slate-500">Read-only preview of this blog post</p>
        </div>
    </div>
    <div class="flex items-center gap-2 flex-shrink-0">
        @if ($blog->status === 'published')
        <a
            href="{{ url('/blog/' . $blog->slug) }}"
            target="_blank"
            class="inline-flex items-center gap-1.5 rounded-xl border border-slate-200 bg-white px-3.5 py-2.5 text-sm font-medium text-slate-600 hover:border-slate-300 hover:text-slate-800 transition-colors"
        >
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/>
            </svg>
            View Live
        </a>
        @endif
        <a
            href="{{ route('admin.blogs.edit', $blog) }}"
            class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-indigo-700 active:bg-indigo-800 transition-colors"
        >
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z"/>
            </svg>
            Edit Post
        </a>
    </div>
</div>
 
{{-- ── TWO COLUMN LAYOUT ───────────────────────────────────── --}}
<div class="grid grid-cols-1 xl:grid-cols-3 gap-5">
 
    {{-- ── LEFT: Post content (2/3) ───────────────────────── --}}
    <div class="xl:col-span-2 space-y-5">
 
        {{-- Featured image --}}
        @if ($blog->featured_image)
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white">
            <img
                src="{{ Storage::url($blog->featured_image) }}"
                alt="{{ $blog->title }}"
                class="h-72 w-full object-cover"
            />
        </div>
        @endif
 
        {{-- Title + meta strip --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-6">
            {{-- Status + category badges --}}
            <div class="mb-4 flex flex-wrap items-center gap-2">
                @php
                    $badge = [
                        'published' => 'bg-emerald-100 text-emerald-700',
                        'draft'     => 'bg-amber-100 text-amber-700',
                        'archived'  => 'bg-slate-100 text-slate-500',
                    ][$blog->status] ?? 'bg-slate-100 text-slate-500';
                @endphp
                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-[11px] font-semibold {{ $badge }} capitalize">
                    {{ $blog->status }}
                </span>
 
                @if ($blog->category)
                <span class="inline-flex items-center rounded-full bg-indigo-50 px-2.5 py-0.5 text-[11px] font-semibold text-indigo-700">
                    {{ $blog->category->name }}
                </span>
                @endif
 
                @foreach ($blog->tags as $tag)
                <span class="inline-flex items-center rounded-full bg-slate-100 px-2.5 py-0.5 text-[11px] font-medium text-slate-600">
                    #{{ $tag->name }}
                </span>
                @endforeach
            </div>
 
            {{-- Title --}}
            <h1 class="text-2xl font-bold text-slate-800 font-display mb-4 leading-snug">
                {{ $blog->title }}
            </h1>
 
            {{-- Author + date --}}
            <div class="flex items-center gap-3 pb-5 border-b border-slate-100">
                <div class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-full bg-indigo-100 text-sm font-semibold text-indigo-700 uppercase">
                    {{ substr($blog->author->name ?? 'A', 0, 1) }}
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-700">{{ $blog->author->name ?? 'Unknown' }}</p>
                    <p class="text-xs text-slate-400">
                        @if ($blog->published_at)
                            Published {{ $blog->published_at->format('F j, Y \a\t g:i A') }}
                        @else
                            Created {{ $blog->created_at->format('F j, Y') }}
                        @endif
                        · Updated {{ $blog->updated_at->diffForHumans() }}
                    </p>
                </div>
            </div>
 
            {{-- Excerpt --}}
            @if ($blog->excerpt)
            <div class="mt-5 rounded-xl border-l-4 border-indigo-400 bg-indigo-50/60 px-4 py-3">
                <p class="text-sm font-medium text-slate-600 italic leading-relaxed">{{ $blog->excerpt }}</p>
            </div>
            @endif
 
            {{-- Content --}}
            <div class="mt-6 prose prose-sm prose-slate max-w-none
                prose-headings:font-bold prose-headings:text-slate-800
                prose-p:text-slate-600 prose-p:leading-relaxed
                prose-a:text-indigo-600 prose-a:no-underline hover:prose-a:underline
                prose-code:rounded prose-code:bg-slate-100 prose-code:px-1.5 prose-code:py-0.5
                prose-img:rounded-xl">
                {!! nl2br(e($blog->content)) !!}
            </div>
        </div>
 
    </div>
 
    {{-- ── RIGHT: Meta / sidebar (1/3) ─────────────────────── --}}
    <div class="space-y-5">
 
        {{-- Post details --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-5">
            <h3 class="text-sm font-semibold text-slate-700 mb-4">Post Details</h3>
            <dl class="space-y-3">
                @foreach ([
                    ['Status',    ucfirst($blog->status)],
                    ['Author',    $blog->author->name ?? '—'],
                    ['Category',  $blog->category->name ?? '—'],
                    ['Slug',      $blog->slug],
                    ['Published', $blog->published_at ? $blog->published_at->format('M j, Y g:i A') : '—'],
                  ] as [$label, $value])
                <div class="flex items-start justify-between gap-2">
                    <dt class="text-xs font-medium text-slate-500 flex-shrink-0 w-24">{{ $label }}</dt>
                    <dd class="text-xs text-slate-700 text-right break-all">{{ $value }}</dd>
                </div>
                @endforeach
            </dl>
        </div>
 
        {{-- Tags --}}
        @if ($blog->tags->isNotEmpty())
        <div class="rounded-2xl border border-slate-200 bg-white p-5">
            <h3 class="text-sm font-semibold text-slate-700 mb-3">Tags</h3>
            <div class="flex flex-wrap gap-2">
                @foreach ($blog->tags as $tag)
                <span class="inline-flex rounded-full bg-indigo-50 px-3 py-1 text-xs font-medium text-indigo-700">
                    #{{ $tag->name }}
                </span>
                @endforeach
            </div>
        </div>
        @endif
 
        {{-- Featured image thumbnail --}}
        @if ($blog->featured_image)
        <div class="rounded-2xl border border-slate-200 bg-white p-5">
            <h3 class="text-sm font-semibold text-slate-700 mb-3">Featured Image</h3>
            <a href="{{ Storage::url($blog->featured_image) }}" target="_blank" class="block group">
                <img
                    src="{{ Storage::url($blog->featured_image) }}"
                    alt="Featured image"
                    class="h-36 w-full rounded-xl object-cover group-hover:opacity-90 transition-opacity"
                />
                <p class="mt-2 text-[11px] text-indigo-600 text-center hover:underline">Open original →</p>
            </a>
        </div>
        @endif
 
        {{-- Quick actions --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-5">
            <h3 class="text-sm font-semibold text-slate-700 mb-3">Quick Actions</h3>
            <div class="flex flex-col gap-2">
                <a
                    href="{{ route('admin.blogs.edit', $blog) }}"
                    class="flex items-center gap-2.5 rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm font-medium text-slate-700 hover:border-indigo-300 hover:bg-indigo-50 hover:text-indigo-700 transition-all"
                >
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931z"/>
                    </svg>
                    Edit this post
                </a>
 
                @if ($blog->status !== 'published')
                <form method="POST" action="{{ route('admin.blogs.update', $blog) }}" x-data>
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="title" value="{{ $blog->title }}">
                    <input type="hidden" name="content" value="{{ $blog->content }}">
                    <input type="hidden" name="category_id" value="{{ $blog->category_id }}">
                    <input type="hidden" name="status" value="published">
                    <button
                        type="submit"
                        class="flex w-full items-center gap-2.5 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-2.5 text-sm font-medium text-emerald-700 hover:bg-emerald-600 hover:text-white hover:border-emerald-600 transition-all"
                    >
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Publish now
                    </button>
                </form>
                @endif
 
                <form
                    method="POST"
                    action="{{ route('admin.blogs.destroy', $blog) }}"
                    x-data
                    @submit.prevent="if(confirm('Delete this post permanently?')) $el.submit()"
                >
                    @csrf
                    @method('DELETE')
                    <button
                        type="submit"
                        class="flex w-full items-center gap-2.5 rounded-xl border border-red-200 bg-red-50 px-4 py-2.5 text-sm font-medium text-red-600 hover:bg-red-600 hover:text-white hover:border-red-600 transition-all"
                    >
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                        </svg>
                        Delete this post
                    </button>
                </form>
            </div>
        </div>
 
    </div>{{-- end right --}}
</div>{{-- end grid --}}
 
@endsection