@extends('layouts.admin')

@section('title', 'Create Service')
@section('page-title', 'Services')

@section('breadcrumb')
    <span class="text-slate-300">/</span>
    <a href="{{ route('admin.services.index') }}" class="hover:text-indigo-600 transition-colors">All Services</a>
    <span class="text-slate-300">/</span>
    <span class="text-slate-500">New Service</span>
@endsection

@section('content')

<form
    method="POST"
    action="{{ route('admin.services.store') }}"
    enctype="multipart/form-data"
    x-data="serviceForm()"
    novalidate
>
    @csrf

    {{-- ── PAGE HEADER ─────────────────────────────────────── --}}
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-xl font-bold text-slate-800 font-display">New Service</h2>
            <p class="mt-0.5 text-sm text-slate-500">Add a service that will be displayed on your public site.</p>
        </div>
        <div class="flex items-center gap-2 flex-shrink-0">
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
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                </svg>
                Create Service
            </button>
        </div>
    </div>

    {{-- ── TWO-COLUMN LAYOUT ───────────────────────────────── --}}
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-5">

        {{-- ══════════════════════════════════════════════════
             LEFT COLUMN — main fields (2/3)
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
                        value="{{ old('title') }}"
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
                </div>

                {{-- Slug preview (auto-generated in model) --}}
                <div class="rounded-xl border border-slate-200 bg-slate-50 px-4 py-3">
                    <p class="mb-1 text-xs font-medium text-slate-500">Auto-generated URL slug</p>
                    <div class="flex items-center gap-2">
                        <svg class="h-3.5 w-3.5 flex-shrink-0 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244"/>
                        </svg>
                        <code class="text-sm font-mono text-indigo-600" x-text="slug || 'your-service-slug'"></code>
                    </div>
                    <p class="mt-1 text-[11px] text-slate-400">Generated from the title. Duplicates are handled automatically.</p>
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

                <label for="icon" class="block text-sm font-medium text-slate-700 mb-1.5">Icon class or name</label>
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
                            value="{{ old('icon') }}"
                            placeholder="e.g. ti-code, fa-laptop, heroicon-code"
                            x-model="icon"
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 py-3 pl-10 pr-4 text-sm text-slate-800 placeholder-slate-400
                                focus:border-indigo-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-100 transition
                                @error('icon') border-red-300 bg-red-50 @enderror"
                        />
                    </div>
                    {{-- Live icon preview --}}
                    <div class="flex h-11 w-11 flex-shrink-0 items-center justify-center rounded-xl border border-slate-200 bg-indigo-50 text-indigo-600">
                        <i :class="icon" x-show="icon" class="text-lg"></i>
                        <svg x-show="!icon" class="h-5 w-5 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5.433 13.917l1.262-3.155A4 4 0 017.58 9.42l6.92-6.918a2.121 2.121 0 013 3l-6.92 6.918c-.383.383-.84.685-1.343.886l-3.154 1.262a.5.5 0 01-.65-.65z"/>
                        </svg>
                    </div>
                </div>
                <p class="mt-2 text-[11px] text-slate-400">Enter any icon class (Tabler, Font Awesome, Heroicons). Displayed on the public services page.</p>
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
                    <span class="text-xs font-normal text-slate-400">(optional — shown on cards)</span>
                </h3>
                <textarea
                    id="short_description"
                    name="short_description"
                    rows="3"
                    placeholder="A one-line or two-line summary shown on the services listing page…"
                    x-model="shortDesc"
                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 placeholder-slate-400
                        focus:border-indigo-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-100 transition resize-y
                        @error('short_description') border-red-300 bg-red-50 @enderror"
                >{{ old('short_description') }}</textarea>
                <div class="mt-1.5 flex items-center justify-between">
                    @error('short_description')
                        <p class="flex items-center gap-1 text-xs text-red-600">
                            <svg class="h-3.5 w-3.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/></svg>
                            {{ $message }}
                        </p>
                    @else
                        <span></span>
                    @enderror
                    <span class="text-[11px] text-slate-400" x-text="shortDesc.length + ' chars'"></span>
                </div>
            </div>

            {{-- ── Full Description ─────────────────────────── --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-6">
                <h3 class="mb-4 flex items-center gap-2 text-sm font-semibold text-slate-700">
                    <span class="flex h-6 w-6 items-center justify-center rounded-md bg-indigo-100">
                        <svg class="h-3.5 w-3.5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z"/>
                        </svg>
                    </span>
                    Full Description <span class="text-red-500">*</span>
                </h3>

                {{-- Clean reusable global invocation line --}}
                <x-quill-editor id="description" name="description" :value="old('description')" />
                
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
                    <label for="status" class="block text-xs font-medium text-slate-600 mb-1.5">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <select
                        id="status"
                        name="status"
                        x-model="status"
                        class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-700
                            focus:border-indigo-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-100 transition
                            @error('status') border-red-300 @enderror"
                    >
                        <option value="draft"     {{ old('status','draft') === 'draft'     ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status')         === 'published' ? 'selected' : '' }}>Published</option>
                        <option value="archived"  {{ old('status')         === 'archived'  ? 'selected' : '' }}>Archived</option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Status badge preview --}}
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
                    <label class="flex cursor-pointer items-center justify-between gap-3 rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 hover:border-indigo-200 hover:bg-indigo-50/40 transition-colors"
                        :class="isFeatured ? 'border-indigo-300 bg-indigo-50' : ''">
                        <div>
                            <p class="text-sm font-medium text-slate-700">Mark as featured</p>
                            <p class="text-xs text-slate-400">Shows in the featured services section</p>
                        </div>
                        {{-- Toggle switch --}}
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
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
                @if ($categories->isEmpty())
                    <p class="mt-2 text-xs text-amber-600">
                        No categories yet.
                        <a href="{{ route('admin.categories.create') }}" class="font-medium underline hover:text-amber-800">Create one →</a>
                    </p>
                @endif
            </div>

            {{-- ── Featured Image ────────────────────────────── --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5">
                <p class="mb-3 text-sm font-semibold text-slate-700">Featured Image</p>

                <div
                    class="relative flex flex-col items-center justify-center rounded-xl border-2 border-dashed border-slate-200 bg-slate-50 p-6 text-center
                        hover:border-indigo-300 hover:bg-indigo-50/40 transition-colors cursor-pointer"
                    x-data="imagePreview()"
                    @click="$refs.fileInput.click()"
                    @dragover.prevent
                    @drop.prevent="handleDrop($event)"
                >
                    {{-- Preview --}}
                    <div x-show="preview" class="mb-3 w-full">
                        <img :src="preview" alt="Preview" class="mx-auto h-36 w-full rounded-lg object-cover"/>
                        <p class="mt-1.5 text-[11px] text-indigo-600 font-medium">Click to change</p>
                    </div>

                    <template x-if="!preview">
                        <div class="flex flex-col items-center gap-2">
                            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-slate-200">
                                <svg class="h-6 w-6 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/>
                                </svg>
                            </div>
                            <p class="text-xs font-medium text-slate-600">Click or drag image here</p>
                            <p class="text-[11px] text-slate-400">JPG, PNG, WebP — max 2MB</p>
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

            {{-- ── Save shortcut ─────────────────────────────── --}}
            <button
                type="submit"
                class="w-full inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 active:bg-indigo-800 transition-colors"
            >
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                </svg>
                Create Service
            </button>

        </div>{{-- end right --}}
    </div>{{-- end grid --}}

</form>

@endsection

@push('scripts')
<script>
function serviceForm() {
    return {
        title:      '{{ old('title') }}',
        slug:       '',
        icon:       '{{ old('icon') }}',
        shortDesc:  '{{ old('short_description') }}',
        status:     '{{ old('status', 'draft') }}',
        isFeatured: {{ old('is_featured', '0') === '1' ? 'true' : 'false' }},

        generateSlug() {
            this.slug = this.title
                .toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .trim()
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');
        },

        init() {
            if (this.title) this.generateSlug();
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