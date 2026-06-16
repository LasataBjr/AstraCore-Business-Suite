
@extends('layouts.admin')

@section('title', 'Edit: ' . $service->title)
@section('page-title', 'Services')

@section('breadcrumb')
    <span class="text-slate-300">/</span>
    <a href="{{ route('admin.services.index') }}" class="hover:text-indigo-600 transition-colors">All Services</a>
    <span class="text-slate-300">/</span>
    <span class="text-slate-500 truncate max-w-[160px]">{{ Str::limit($service->title, 30) }}</span>
@endsection

@section('content')

{{-- ================================================================
     UPDATE FORM — only update fields inside, NO delete action here
================================================================= --}}
<form
    method="POST"
    action="{{ route('admin.services.update', $service) }}"
    enctype="multipart/form-data"
    x-data="serviceForm()"
    novalidate
>
    @csrf
    @method('PUT')

    {{-- ── PAGE HEADER ─────────────────────────────────────── --}}
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-xl font-bold text-slate-800 font-display">Edit Service</h2>
            <p class="mt-0.5 text-sm text-slate-500">
                Last updated {{ $service->updated_at->diffForHumans() }}
                · Created {{ $service->created_at->format('M j, Y') }}
            </p>
        </div>
        <div class="flex items-center gap-2 flex-shrink-0">
            @if ($service->status === 'published')
            <a
                href="{{ url('/services/' . $service->slug) }}"
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
                href="{{ route('admin.services.index') }}"
                class="rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-medium text-slate-600 hover:border-slate-300 hover:text-slate-800 transition-colors"
            >
                Cancel
            </a>
            <button
                type="submit"
                class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 active:bg-indigo-800 transition-colors"
            >
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                </svg>
                Save Changes
            </button>
        </div>
    </div>

    {{-- ── TWO-COLUMN LAYOUT ───────────────────────────────── --}}
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-5">

        {{-- ══════════════════════════════════════════════════
             LEFT COLUMN — main content (2/3)
        ══════════════════════════════════════════════════ --}}
        <div class="xl:col-span-2 space-y-5">

            {{-- ── Title + Slug ─────────────────────────────── --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-6">
                <h3 class="mb-5 flex items-center gap-2 text-sm font-semibold text-slate-700">
                    <span class="flex h-6 w-6 items-center justify-center rounded-md bg-indigo-100">
                        <svg class="h-3.5 w-3.5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63"/>
                        </svg>
                    </span>
                    Service Identity
                </h3>

                {{-- Title --}}
                <div class="mb-5">
                    <label for="title" class="block text-sm font-medium text-slate-700 mb-1.5">
                        Service Title <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        id="title"
                        name="title"
                        value="{{ old('title', $service->title) }}"
                        placeholder="e.g. Laravel Development, UI/UX Design…"
                        x-model="title"
                        @input="generateSlug()"
                        maxlength="255"
                        class="w-full rounded-xl border bg-slate-50 px-4 py-3 text-sm text-slate-800 placeholder-slate-400
                            focus:bg-white focus:outline-none focus:ring-2 transition
                            @error('title') border-red-300 bg-red-50 focus:border-red-400 focus:ring-red-100
                            @else border-slate-200 focus:border-indigo-400 focus:ring-indigo-100 @enderror"
                    />
                    @error('title')
                        <p class="mt-1.5 flex items-center gap-1 text-xs text-red-600">
                            <svg class="h-3.5 w-3.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/></svg>
                            {{ $message }}
                        </p>
                    @enderror
                    <p class="mt-1.5 text-xs text-slate-400">Changing the title will auto-update the slug on save.</p>
                </div>

                {{-- Slug preview --}}
                <div class="rounded-xl border border-slate-200 bg-slate-50 px-4 py-3">
                    <p class="mb-1 text-xs font-medium text-slate-500">Current URL slug</p>
                    <div class="flex items-center gap-2">
                        <svg class="h-3.5 w-3.5 flex-shrink-0 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244"/>
                        </svg>
                        <code class="text-sm font-mono text-indigo-600" x-text="slug"></code>
                    </div>
                    <p class="mt-1 text-[11px] text-slate-400">Updated automatically when title changes. Duplicates handled.</p>
                </div>
            </div>

            {{-- ── Icon ─────────────────────────────────────── --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-6">
                <h3 class="mb-4 flex items-center gap-2 text-sm font-semibold text-slate-700">
                    <span class="flex h-6 w-6 items-center justify-center rounded-md bg-indigo-100">
                        <svg class="h-3.5 w-3.5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5.433 13.917l1.262-3.155A4 4 0 017.58 9.42l6.92-6.918a2.121 2.121 0 013 3l-6.92 6.918c-.383.383-.84.685-1.343.886l-3.154 1.262a.5.5 0 01-.65-.65z"/>
                        </svg>
                    </span>
                    Icon
                    <span class="text-xs font-normal text-slate-400">(optional)</span>
                </h3>

                <div class="flex items-center gap-3">
                    <div class="relative flex-1">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
                            <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5.433 13.917l1.262-3.155A4 4 0 017.58 9.42l6.92-6.918a2.121 2.121 0 013 3l-6.92 6.918c-.383.383-.84.685-1.343.886l-3.154 1.262a.5.5 0 01-.65-.65z"/>
                            </svg>
                        </div>
                        <input
                            type="text"
                            id="icon"
                            name="icon"
                            value="{{ old('icon', $service->icon) }}"
                            placeholder="e.g. ti-code, fa-laptop"
                            x-model="icon"
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 py-3 pl-10 pr-4 text-sm text-slate-800 placeholder-slate-400
                                focus:border-indigo-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-100 transition
                                @error('icon') border-red-300 bg-red-50 @enderror"
                        />
                    </div>
                    <div class="flex h-11 w-11 flex-shrink-0 items-center justify-center rounded-xl border border-slate-200 bg-indigo-50 text-indigo-600">
                        <i :class="icon" x-show="icon" class="text-lg"></i>
                        <svg x-show="!icon" class="h-5 w-5 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5.433 13.917l1.262-3.155A4 4 0 017.58 9.42l6.92-6.918a2.121 2.121 0 013 3l-6.92 6.918"/>
                        </svg>
                    </div>
                </div>
                @error('icon')
                    <p class="mt-1.5 flex items-center gap-1 text-xs text-red-600">
                        <svg class="h-3.5 w-3.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/></svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- ── Short Description ────────────────────────── --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-6">
                <h3 class="mb-4 flex items-center gap-2 text-sm font-semibold text-slate-700">
                    <span class="flex h-6 w-6 items-center justify-center rounded-md bg-indigo-100">
                        <svg class="h-3.5 w-3.5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12"/>
                        </svg>
                    </span>
                    Short Description
                    <span class="text-xs font-normal text-slate-400">(shown on cards)</span>
                </h3>
                <textarea
                    id="short_description"
                    name="short_description"
                    rows="3"
                    placeholder="Brief summary shown on the services listing page…"
                    x-model="shortDesc"
                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 placeholder-slate-400
                        focus:border-indigo-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-100 transition resize-y
                        @error('short_description') border-red-300 bg-red-50 @enderror"
                >{{ old('short_description', $service->short_description) }}</textarea>
                <div class="mt-1.5 flex justify-end">
                    <span class="text-[11px] text-slate-400" x-text="shortDesc.length + ' chars'"></span>
                </div>
                @error('short_description')
                    <p class="mt-1 flex items-center gap-1 text-xs text-red-600">
                        <svg class="h-3.5 w-3.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/></svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- ── Full Description ─────────────────────────── --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-6">
                <h3 class="mb-4 flex items-center gap-2 text-sm font-semibold text-slate-700">
                    <span class="flex h-6 w-6 items-center justify-center rounded-md bg-indigo-100">
                        <svg class="h-3.5 w-3.5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5"/>
                        </svg>
                    </span>
                    Full Description <span class="text-red-500">*</span>
                </h3>
                
                <x-quill-editor id="description" name="description" :value="old('description', $service->description)" />

                @error('description')
                    <p class="mt-1.5 flex items-center gap-1 text-xs text-red-600">
                        <svg class="h-3.5 w-3.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/></svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

        </div>

        {{-- ══════════════════════════════════════════════════
             RIGHT COLUMN — settings sidebar (1/3)
        ══════════════════════════════════════════════════ --}}
        <div class="space-y-5">

            {{-- ── Publish Settings ─────────────────────────── --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5">
                <h3 class="mb-4 text-sm font-semibold text-slate-700">Publish Settings</h3>

                {{-- Status --}}
                <div class="mb-4">
                    <label for="status" class="block text-xs font-medium text-slate-600 mb-1.5">Status <span class="text-red-500">*</span></label>
                    <select
                        id="status"
                        name="status"
                        x-model="status"
                        class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-700
                            focus:border-indigo-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-100 transition
                            @error('status') border-red-300 @enderror"
                    >
                        <option value="draft"     {{ old('status', $service->status) === 'draft'     ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status', $service->status) === 'published' ? 'selected' : '' }}>Published</option>
                        <option value="archived"  {{ old('status', $service->status) === 'archived'  ? 'selected' : '' }}>Archived</option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Status preview badge --}}
                <div class="mb-4 flex items-center justify-between rounded-xl border border-slate-100 bg-slate-50 px-3 py-2.5 text-xs text-slate-500">
                    <span>Preview</span>
                    <span
                        x-text="{ draft: 'Draft', published: 'Published', archived: 'Archived' }[status]"
                        :class="{
                            'bg-emerald-100 text-emerald-700': status === 'published',
                            'bg-amber-100 text-amber-700':    status === 'draft',
                            'bg-slate-100 text-slate-500':    status === 'archived'
                        }"
                        class="inline-flex rounded-full px-2.5 py-0.5 text-[11px] font-semibold"
                    ></span>
                </div>

                {{-- Is Featured toggle --}}
                <div>
                    <p class="text-xs font-medium text-slate-600 mb-2">Featured Service</p>
                    <label
                        class="flex cursor-pointer items-center justify-between gap-3 rounded-xl border px-4 py-3 transition-colors"
                        :class="isFeatured ? 'border-indigo-300 bg-indigo-50' : 'border-slate-200 bg-slate-50 hover:border-indigo-200 hover:bg-indigo-50/40'"
                    >
                        <div>
                            <p class="text-sm font-medium text-slate-700">Mark as featured</p>
                            <p class="text-xs text-slate-400">Shows in the featured section</p>
                        </div>
                        <div
                            class="relative flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full transition-colors duration-200"
                            :class="isFeatured ? 'bg-indigo-500' : 'bg-slate-300'"
                            @click="isFeatured = !isFeatured"
                        >
                            <span
                                class="absolute top-0.5 left-0.5 h-5 w-5 rounded-full bg-white shadow-sm transition-transform duration-200"
                                :class="isFeatured ? 'translate-x-5' : 'translate-x-0'"
                            ></span>
                        </div>
                        <input type="hidden" name="is_featured" :value="isFeatured ? '1' : '0'" />
                    </label>
                </div>
            </div>

            {{-- ── Category ──────────────────────────────────── --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5">
                <label for="category_id" class="block text-sm font-semibold text-slate-700 mb-3">
                    Category
                    <span class="text-xs font-normal text-slate-400">(optional)</span>
                </label>
                <select
                    id="category_id"
                    name="category_id"
                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-700
                        focus:border-indigo-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-100 transition
                        @error('category_id') border-red-300 @enderror"
                >
                    <option value="">No category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $service->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- ── Featured Image ────────────────────────────── --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5">
                <p class="mb-3 text-sm font-semibold text-slate-700">Featured Image</p>

                {{-- Current image --}}
                @if ($service->featured_image)
                <div class="mb-3 group relative">
                    <img
                        src="{{ Storage::url($service->featured_image) }}"
                        alt="Current image"
                        class="h-36 w-full rounded-xl object-cover"
                    />
                    <div class="absolute inset-0 flex items-center justify-center rounded-xl bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity">
                        <p class="text-xs font-medium text-white">Upload new to replace</p>
                    </div>
                </div>
                @endif

                {{-- Drop zone --}}
                <div
                    class="relative flex flex-col items-center justify-center rounded-xl border-2 border-dashed border-slate-200 bg-slate-50 p-5 text-center
                        hover:border-indigo-300 hover:bg-indigo-50/40 transition-colors cursor-pointer"
                    x-data="imagePreview()"
                    @click="$refs.fileInput.click()"
                    @dragover.prevent
                    @drop.prevent="handleDrop($event)"
                >
                    <div x-show="preview" class="mb-2 w-full">
                        <img :src="preview" alt="New preview" class="mx-auto h-28 w-full rounded-lg object-cover"/>
                        <p class="mt-1.5 text-[11px] text-indigo-600 font-medium">New image selected</p>
                    </div>
                    <template x-if="!preview">
                        <div class="flex flex-col items-center gap-1.5">
                            <svg class="h-7 w-7 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/>
                            </svg>
                            <p class="text-xs font-medium text-slate-500">{{ $service->featured_image ? 'Click to replace' : 'Click or drag to upload' }}</p>
                            <p class="text-[10px] text-slate-400">JPG, PNG, WebP — max 2MB</p>
                        </div>
                    </template>
                    <input
                        type="file"
                        name="featured_image"
                        accept="image/jpeg,image/png,image/webp"
                        x-ref="fileInput"
                        @change="handleChange($event)"
                        class="sr-only"
                    />
                </div>
                @error('featured_image')
                    <p class="mt-1.5 flex items-center gap-1 text-xs text-red-600">
                        <svg class="h-3.5 w-3.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/></svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- ── Meta Info ─────────────────────────────────── --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5">
                <h3 class="mb-3 text-sm font-semibold text-slate-700">Details</h3>
                <dl class="space-y-2.5">
                    @foreach ([
                        ['ID',       '#' . $service->id],
                        ['Slug',     $service->slug],
                        ['Category', $service->category->name ?? 'None'],
                        ['Created',  $service->created_at->format('M j, Y')],
                        ['Updated',  $service->updated_at->format('M j, Y')],
                    ] as [$key, $val])
                    <div class="flex items-center justify-between gap-2">
                        <dt class="text-xs font-medium text-slate-500 flex-shrink-0">{{ $key }}</dt>
                        <dd class="text-xs text-slate-700 font-mono truncate text-right">{{ $val }}</dd>
                    </div>
                    @endforeach
                </dl>
            </div>

            {{-- ── Save shortcut ─────────────────────────────── --}}
            <button
                type="submit"
                class="w-full inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 active:bg-indigo-800 transition-colors"
            >
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                </svg>
                Save Changes
            </button>

        </div>{{-- end right --}}
    </div>{{-- end grid --}}

</form>
{{-- ================================================================
     END OF UPDATE FORM
================================================================= --}}


{{-- ================================================================
     DANGER ZONE — completely separate standalone form outside update
================================================================= --}}
<div class="mt-8">
    <div class="mb-5 flex items-center gap-3">
        <div class="flex-1 border-t border-slate-200"></div>
        <span class="flex-shrink-0 text-[11px] font-semibold uppercase tracking-widest text-slate-400">Danger Zone</span>
        <div class="flex-1 border-t border-slate-200"></div>
    </div>

    <div class="rounded-2xl border border-red-200 bg-red-50/50 p-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            <div class="flex items-start gap-3">
                <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-xl bg-red-100">
                    <svg class="h-5 w-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-semibold text-red-800">Delete this service</p>
                    <p class="mt-0.5 text-xs text-red-600 max-w-md">
                        Permanently removes <strong>{{ $service->title }}</strong> and its featured image. This action cannot be undone.
                    </p>
                </div>
            </div>

            {{-- Standalone delete form — own @csrf + @method DELETE, outside update form --}}
            <form
                method="POST"
                action="{{ route('admin.services.destroy', $service) }}"
                x-data
                @submit.prevent="if(confirm('Permanently delete «{{ addslashes($service->title) }}»?\n\nThis action cannot be undone.')) $el.submit()"
                class="flex-shrink-0"
            >
                @csrf
                @method('DELETE')
                <button
                    type="submit"
                    class="inline-flex items-center gap-2 rounded-xl border border-red-300 bg-white px-5 py-2.5 text-sm font-semibold text-red-700
                        hover:bg-red-600 hover:text-white hover:border-red-600
                        focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2
                        transition-all"
                >
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                    </svg>
                    Delete Service
                </button>
            </form>

        </div>
    </div>
</div>
{{-- ================================================================
     END DANGER ZONE
================================================================= --}}

@endsection

@push('scripts')
<script>
function serviceForm() {
    return {
        title:      '{{ addslashes(old('title', $service->title)) }}',
        slug:       '{{ $service->slug }}',
        icon:       '{{ addslashes(old('icon', $service->icon ?? '')) }}',
        shortDesc:  `{{ addslashes(old('short_description', $service->short_description ?? '')) }}`,
        status:     '{{ old('status', $service->status) }}',
        isFeatured: {{ old('is_featured', $service->is_featured ? '1' : '0') === '1' ? 'true' : 'false' }},

        generateSlug() {
            this.slug = this.title
                .toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .trim()
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');
        }
    }
}

function imagePreview() {
    return {
        preview: null,
        handleChange(e) {
            const file = e.target.files[0];
            if (file) this.preview = URL.createObjectURL(file);
        },
        handleDrop(e) {
            const file = e.dataTransfer.files[0];
            if (file && file.type.startsWith('image/')) {
                this.$refs.fileInput.files = e.dataTransfer.files;
                this.preview = URL.createObjectURL(file);
            }
        }
    }
}
</script>
@endpush