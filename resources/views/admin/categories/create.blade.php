{{--
    Categories — Create Page
    Path: resources/views/admin/categories/create.blade.php
    Controller: App\Http\Controllers\Admin\CategoryController@create / store
--}}

@extends('layouts.admin')

@section('title', 'Create Category')
@section('page-title', 'Categories')

@section('breadcrumb')
    <span class="text-slate-300">/</span>
    <a href="{{ route('admin.categories.index') }}" class="hover:text-indigo-600 transition-colors">All Categories</a>
    <span class="text-slate-300">/</span>
    <span class="text-slate-500">New Category</span>
@endsection

@section('content')

<form
    method="POST"
    action="{{ route('admin.categories.store') }}"
    x-data="categoryForm()"
    novalidate
>
    @csrf

    {{-- ── PAGE HEADER ─────────────────────────────────────── --}}
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-xl font-bold text-slate-800 font-display">New Category</h2>
            <p class="mt-0.5 text-sm text-slate-500">Categories help organise your services, projects and blog posts.</p>
        </div>
        <div class="flex items-center gap-2 flex-shrink-0">
            <a
                href="{{ route('admin.categories.index') }}"
                class="rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-medium text-slate-600 hover:border-slate-300 hover:text-slate-800 transition-colors"
            >
                Cancel
            </a>
            <button
                type="submit"
                class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 active:bg-indigo-800 transition-colors"
            >
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                </svg>
                Create Category
            </button>
        </div>
    </div>

    {{-- ── MAIN FORM GRID ──────────────────────────────────── --}}
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-5">

        {{-- ── LEFT: Core fields (2/3) ─────────────────────── --}}
        <div class="xl:col-span-2 space-y-5">

            {{-- Name + Slug card --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-6">
                <h3 class="mb-5 text-sm font-semibold text-slate-700 flex items-center gap-2">
                    <span class="flex h-6 w-6 items-center justify-center rounded-md bg-indigo-100">
                        <svg class="h-3.5 w-3.5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z"/>
                        </svg>
                    </span>
                    Category Identity
                </h3>

                {{-- Name --}}
                <div class="mb-5">
                    <label for="name" class="block text-sm font-medium text-slate-700 mb-1.5">
                        Category Name <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="e.g. Web Development, Mobile Apps…"
                        x-model="name"
                        @input="generateSlug()"
                        maxlength="255"
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
                    <p class="mt-1.5 text-xs text-slate-400">Maximum 255 characters. Must be unique.</p>
                </div>

                {{-- Auto-generated slug preview --}}
                <div class="rounded-xl border border-slate-200 bg-slate-50 px-4 py-3">
                    <p class="mb-1 text-xs font-medium text-slate-500">Auto-generated URL slug</p>
                    <div class="flex items-center gap-2">
                        <svg class="h-3.5 w-3.5 text-slate-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244"/>
                        </svg>
                        <code class="text-sm font-mono text-indigo-600" x-text="slug || 'your-category-slug'"></code>
                    </div>
                    <p class="mt-1.5 text-[11px] text-slate-400">Generated automatically from the name. Cannot be edited manually.</p>
                </div>
            </div>

            {{-- Description card --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-6">
                <h3 class="mb-4 text-sm font-semibold text-slate-700 flex items-center gap-2">
                    <span class="flex h-6 w-6 items-center justify-center rounded-md bg-indigo-100">
                        <svg class="h-3.5 w-3.5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12"/>
                        </svg>
                    </span>
                    Description
                    <span class="text-xs font-normal text-slate-400">(optional)</span>
                </h3>

                <textarea
                    id="description"
                    name="description"
                    rows="5"
                    placeholder="Briefly describe what this category covers…"
                    x-model="description"
                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 placeholder-slate-400
                        focus:border-indigo-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-100
                        transition resize-y
                        @error('description') border-red-300 bg-red-50 @enderror"
                >{{ old('description') }}</textarea>

                @error('description')
                    <p class="mt-1.5 flex items-center gap-1 text-xs text-red-600">
                        <svg class="h-3.5 w-3.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/></svg>
                        {{ $message }}
                    </p>
                @enderror

                {{-- Character count --}}
                <div class="mt-2 flex justify-end">
                    <span class="text-[11px] text-slate-400" x-text="description.length + ' characters'"></span>
                </div>
            </div>

        </div>

        {{-- ── RIGHT: Settings sidebar (1/3) ────────────────── --}}
        <div class="space-y-5">

            {{-- Status card --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5">
                <h3 class="mb-4 text-sm font-semibold text-slate-700">Status</h3>

                {{-- Toggle-style radio group --}}
                <div class="space-y-2" x-data="{ status: '{{ old('status', 'active') }}' }">

                    {{-- Active --}}
                    <label
                        class="flex cursor-pointer items-center gap-3 rounded-xl border p-3.5 transition-all"
                        :class="status === 'active'
                            ? 'border-emerald-300 bg-emerald-50'
                            : 'border-slate-200 bg-slate-50 hover:border-slate-300'"
                    >
                        <input
                            type="radio"
                            name="status"
                            value="active"
                            x-model="status"
                            class="hidden"
                        />
                        <div
                            class="flex h-4 w-4 flex-shrink-0 items-center justify-center rounded-full border-2 transition-colors"
                            :class="status === 'active' ? 'border-emerald-500 bg-emerald-500' : 'border-slate-300 bg-white'"
                        >
                            <div x-show="status === 'active'" class="h-1.5 w-1.5 rounded-full bg-white"></div>
                        </div>
                        <div>
                            <p class="text-sm font-medium" :class="status === 'active' ? 'text-emerald-800' : 'text-slate-700'">Active</p>
                            <p class="text-xs" :class="status === 'active' ? 'text-emerald-600' : 'text-slate-400'">Visible and usable across the site</p>
                        </div>
                        <span x-show="status === 'active'" class="ml-auto flex-shrink-0">
                            <svg class="h-4 w-4 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                            </svg>
                        </span>
                    </label>

                    {{-- Inactive --}}
                    <label
                        class="flex cursor-pointer items-center gap-3 rounded-xl border p-3.5 transition-all"
                        :class="status === 'inactive'
                            ? 'border-slate-400 bg-slate-100'
                            : 'border-slate-200 bg-slate-50 hover:border-slate-300'"
                    >
                        <input
                            type="radio"
                            name="status"
                            value="inactive"
                            x-model="status"
                            class="hidden"
                        />
                        <div
                            class="flex h-4 w-4 flex-shrink-0 items-center justify-center rounded-full border-2 transition-colors"
                            :class="status === 'inactive' ? 'border-slate-500 bg-slate-500' : 'border-slate-300 bg-white'"
                        >
                            <div x-show="status === 'inactive'" class="h-1.5 w-1.5 rounded-full bg-white"></div>
                        </div>
                        <div>
                            <p class="text-sm font-medium" :class="status === 'inactive' ? 'text-slate-800' : 'text-slate-700'">Inactive</p>
                            <p class="text-xs text-slate-400">Hidden from public-facing pages</p>
                        </div>
                        <span x-show="status === 'inactive'" class="ml-auto flex-shrink-0">
                            <svg class="h-4 w-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                            </svg>
                        </span>
                    </label>

                </div>

                @error('status')
                    <p class="mt-2 flex items-center gap-1 text-xs text-red-600">
                        <svg class="h-3.5 w-3.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/></svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Info card --}}
            <div class="rounded-2xl border border-indigo-100 bg-indigo-50/60 p-5">
                <div class="flex items-start gap-3">
                    <div class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-lg bg-indigo-100">
                        <svg class="h-4 w-4 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-indigo-800 mb-1">How categories work</p>
                        <ul class="space-y-1 text-xs text-indigo-700">
                            <li class="flex items-start gap-1.5">
                                <svg class="mt-0.5 h-3 w-3 flex-shrink-0 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                                Shared across Services, Projects and Blog Posts
                            </li>
                            <li class="flex items-start gap-1.5">
                                <svg class="mt-0.5 h-3 w-3 flex-shrink-0 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                                Slug is auto-generated from the name
                            </li>
                            <li class="flex items-start gap-1.5">
                                <svg class="mt-0.5 h-3 w-3 flex-shrink-0 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/></svg>
                                Inactive categories are hidden from visitors
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Submit shortcut (repeated for convenience) --}}
            <button
                type="submit"
                class="w-full inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 active:bg-indigo-800 transition-colors"
            >
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                </svg>
                Create Category
            </button>

        </div>
    </div>

</form>

@endsection

@push('scripts')
<script>
function categoryForm() {
    return {
        name:        '{{ old('name') }}',
        slug:        '',
        description: '{{ old('description') }}',

        generateSlug() {
            this.slug = this.name
                .toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .trim()
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');
        },

        init() {
            if (this.name) this.generateSlug();
        }
    }
}
</script>
@endpush