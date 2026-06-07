
@extends('layouts.admin')

@section('title', 'Create Project')
@section('page-title', 'Projects')

@section('breadcrumb')
    <span class="text-slate-300">/</span>
    <a href="{{ route('admin.projects.index') }}" class="hover:text-indigo-600 transition-colors">All Projects</a>
    <span class="text-slate-300">/</span>
    <span class="text-slate-500">New Project</span>
@endsection

@section('content')

<form
    method="POST"
    action="{{ route('admin.projects.store') }}"
    enctype="multipart/form-data"
    x-data="projectForm()"
    novalidate
>
    @csrf

    {{-- ── PAGE HEADER ─────────────────────────────────────── --}}
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-xl font-bold text-slate-800 font-display">New Project</h2>
            <p class="mt-0.5 text-sm text-slate-500">Add a portfolio project with images and project details.</p>
        </div>
        <div class="flex items-center gap-2 flex-shrink-0">
            <a href="{{ route('admin.projects.index') }}" class="rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-medium text-slate-600 hover:border-slate-300 hover:text-slate-800 transition-colors">Cancel</a>
            <button type="submit" class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 active:bg-indigo-800 transition-colors">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                Create Project
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-5">

        {{-- ══════════════════════════════════════════
             LEFT — Main fields (2/3)
        ══════════════════════════════════════════ --}}
        <div class="xl:col-span-2 space-y-5">

            {{-- ── Title + Slug ──────────────────────────── --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-6">
                <h3 class="mb-5 flex items-center gap-2 text-sm font-semibold text-slate-700">
                    <span class="flex h-6 w-6 items-center justify-center rounded-md bg-indigo-100">
                        <svg class="h-3.5 w-3.5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M6.429 9.75L2.25 12l4.179 2.25m0-4.5l5.571 3 5.571-3m-11.142 0L2.25 7.5 12 2.25l9.75 5.25-4.179 2.25m0 0L21.75 12l-4.179 2.25m0 0l4.179 2.25L12 21.75 2.25 16.5l4.179-2.25m11.142 0l-5.571 3-5.571-3"/></svg>
                    </span>
                    Project Identity
                </h3>

                <div class="mb-5">
                    <label for="title" class="block text-sm font-medium text-slate-700 mb-1.5">Project Title <span class="text-red-500">*</span></label>
                    <input
                        type="text" id="title" name="title"
                        value="{{ old('title') }}"
                        placeholder="e.g. E-Commerce Platform, Brand Redesign…"
                        x-model="title" @input="generateSlug()" maxlength="255"
                        class="w-full rounded-xl border bg-slate-50 px-4 py-3 text-sm text-slate-800 placeholder-slate-400
                            focus:bg-white focus:outline-none focus:ring-2 transition
                            @error('title') border-red-300 bg-red-50 focus:border-red-400 focus:ring-red-100
                            @else border-slate-200 focus:border-indigo-400 focus:ring-indigo-100 @enderror"
                    />
                    @error('title')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>

                <div class="rounded-xl border border-slate-200 bg-slate-50 px-4 py-3">
                    <p class="mb-1 text-xs font-medium text-slate-500">Auto-generated slug</p>
                    <div class="flex items-center gap-2">
                        <svg class="h-3.5 w-3.5 flex-shrink-0 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244"/></svg>
                        <code class="text-sm font-mono text-indigo-600" x-text="slug || 'your-project-slug'"></code>
                    </div>
                </div>
            </div>

            {{-- ── Client + URL ───────────────────────────── --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-6">
                <h3 class="mb-5 flex items-center gap-2 text-sm font-semibold text-slate-700">
                    <span class="flex h-6 w-6 items-center justify-center rounded-md bg-indigo-100">
                        <svg class="h-3.5 w-3.5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/></svg>
                    </span>
                    Client & Project URL
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    {{-- Client name --}}
                    <div>
                        <label for="client_name" class="block text-sm font-medium text-slate-700 mb-1.5">Client Name <span class="text-xs font-normal text-slate-400">(optional)</span></label>
                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
                                <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                            </div>
                            <input
                                type="text" id="client_name" name="client_name"
                                value="{{ old('client_name') }}"
                                placeholder="e.g. Acme Corp"
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 py-3 pl-10 pr-4 text-sm text-slate-800 placeholder-slate-400
                                    focus:border-indigo-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-100 transition"
                            />
                        </div>
                    </div>

                    {{-- Project URL --}}
                    <div>
                        <label for="project_url" class="block text-sm font-medium text-slate-700 mb-1.5">Live Project URL <span class="text-xs font-normal text-slate-400">(optional)</span></label>
                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
                                <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                            </div>
                            <input
                                type="url" id="project_url" name="project_url"
                                value="{{ old('project_url') }}"
                                placeholder="https://client-project.com"
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 py-3 pl-10 pr-4 text-sm text-slate-800 placeholder-slate-400
                                    focus:border-indigo-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-100 transition"
                            />
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── Description ────────────────────────────── --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-6">
                <h3 class="mb-4 flex items-center gap-2 text-sm font-semibold text-slate-700">
                    <span class="flex h-6 w-6 items-center justify-center rounded-md bg-indigo-100">
                        <svg class="h-3.5 w-3.5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12"/></svg>
                    </span>
                    Description <span class="text-red-500">*</span>
                </h3>

                <div class="mb-2 flex flex-wrap gap-1.5">
                    @foreach(['B','I','U','H1','H2','UL','OL','Link'] as $tool)
                    <button type="button" class="rounded border border-slate-200 bg-slate-50 px-2 py-1 text-[11px] font-semibold text-slate-500 hover:bg-slate-100 hover:text-slate-700 transition-colors">{{ $tool }}</button>
                    @endforeach
                </div>

                <textarea id="description" name="description" rows="10"
                    placeholder="Describe the project — scope, technologies used, challenges solved, results delivered…"
                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 placeholder-slate-400
                        focus:border-indigo-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-100 transition resize-y
                        @error('description') border-red-300 bg-red-50 @enderror"
                >{{ old('description') }}</textarea>
                @error('description')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>

            {{-- ── Gallery Images ──────────────────────────── --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-6">
                <h3 class="mb-2 flex items-center gap-2 text-sm font-semibold text-slate-700">
                    <span class="flex h-6 w-6 items-center justify-center rounded-md bg-indigo-100">
                        <svg class="h-3.5 w-3.5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/></svg>
                    </span>
                    Gallery Images
                    <span class="text-xs font-normal text-slate-400">(multiple allowed — used for full image slider)</span>
                </h3>

                <p class="mb-4 text-xs text-slate-500">These images appear in the project detail gallery/slider. You can upload multiple at once.</p>

                {{-- Drop zone --}}
                <div
                    class="relative flex flex-col items-center justify-center rounded-xl border-2 border-dashed border-slate-200 bg-slate-50 p-8 text-center
                        hover:border-indigo-300 hover:bg-indigo-50/40 transition-colors cursor-pointer"
                    x-data="galleryUpload()"
                    @click="$refs.galleryInput.click()"
                    @dragover.prevent
                    @drop.prevent="handleDrop($event)"
                >
                    {{-- Previews grid --}}
                    <div x-show="previews.length > 0" class="w-full mb-3">
                        <div class="grid grid-cols-3 sm:grid-cols-4 gap-2">
                            <template x-for="(src, i) in previews" :key="i">
                                <div class="relative group">
                                    <img :src="src" class="h-20 w-full rounded-lg object-cover"/>
                                    <button
                                        type="button"
                                        @click.stop="removePreview(i)"
                                        class="absolute top-1 right-1 flex h-5 w-5 items-center justify-center rounded-full bg-red-500 text-white opacity-0 group-hover:opacity-100 transition-opacity"
                                    >
                                        <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                                    </button>
                                </div>
                            </template>
                        </div>
                        <p class="mt-2 text-xs font-medium text-indigo-600" x-text="previews.length + ' image(s) selected — click to add more'"></p>
                    </div>

                    <template x-if="previews.length === 0">
                        <div class="flex flex-col items-center gap-3">
                            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-200">
                                <svg class="h-7 w-7 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5z"/></svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-slate-600">Click or drag images here</p>
                                <p class="text-xs text-slate-400 mt-1">Upload multiple JPG, PNG or WebP images — max 2MB each</p>
                            </div>
                        </div>
                    </template>

                    <input
                        type="file" name="images[]" multiple accept="image/*"
                        x-ref="galleryInput"
                        @change="handleChange($event)"
                        class="sr-only"
                    />
                </div>

                @error('images.*')<p class="mt-2 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>

        </div>

        {{-- ══════════════════════════════════════════
             RIGHT — Settings sidebar (1/3)
        ══════════════════════════════════════════ --}}
        <div class="space-y-5">

            {{-- Publish Settings --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5">
                <h3 class="mb-4 text-sm font-semibold text-slate-700">Publish Settings</h3>

                {{-- Status --}}
                <div class="mb-4">
                    <label for="status" class="block text-xs font-medium text-slate-600 mb-1.5">Status <span class="text-red-500">*</span></label>
                    <select id="status" name="status" x-model="status"
                        class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-700
                            focus:border-indigo-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-100 transition
                            @error('status') border-red-300 @enderror">
                        <option value="active"   {{ old('status','active') === 'active'   ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status')          === 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')<p class="mt-1 text-xs text-red-600">{{ $message }}</p>@enderror
                </div>

                {{-- Status badge preview --}}
                <div class="mb-4 flex items-center justify-between rounded-xl border border-slate-100 bg-slate-50 px-3 py-2.5 text-xs text-slate-500">
                    <span>Preview</span>
                    <span
                        x-text="status === 'active' ? 'Active' : 'Inactive'"
                        :class="status === 'active' ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-500'"
                        class="inline-flex items-center gap-1.5 rounded-full px-2.5 py-0.5 text-[11px] font-semibold"
                    ></span>
                </div>

                {{-- Is Featured --}}
                <div>
                    <p class="text-xs font-medium text-slate-600 mb-2">Featured Project</p>
                    <label class="flex cursor-pointer items-center justify-between gap-3 rounded-xl border px-4 py-3 transition-colors"
                        :class="isFeatured ? 'border-indigo-300 bg-indigo-50' : 'border-slate-200 bg-slate-50 hover:border-indigo-200 hover:bg-indigo-50/40'">
                        <div>
                            <p class="text-sm font-medium text-slate-700">Mark as featured</p>
                            <p class="text-xs text-slate-400">Highlighted on the homepage</p>
                        </div>
                        <div class="relative flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full transition-colors duration-200"
                            :class="isFeatured ? 'bg-indigo-500' : 'bg-slate-300'"
                            @click="isFeatured = !isFeatured">
                            <span class="absolute top-0.5 left-0.5 h-5 w-5 rounded-full bg-white shadow-sm transition-transform duration-200"
                                :class="isFeatured ? 'translate-x-5' : 'translate-x-0'"></span>
                        </div>
                        <input type="hidden" name="is_featured" :value="isFeatured ? '1' : '0'"/>
                    </label>
                </div>
            </div>

            {{-- Category --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5">
                <label for="category_id" class="block text-sm font-semibold text-slate-700 mb-3">Category <span class="text-xs font-normal text-slate-400">(optional)</span></label>
                <select id="category_id" name="category_id"
                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-700
                        focus:border-indigo-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-100 transition">
                    <option value="">No category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Completion Date --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5">
                <label for="completion_date" class="block text-sm font-semibold text-slate-700 mb-3">
                    Completion Date <span class="text-xs font-normal text-slate-400">(optional)</span>
                </label>
                <input
                    type="date" id="completion_date" name="completion_date"
                    value="{{ old('completion_date') }}"
                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-700
                        focus:border-indigo-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-100 transition"
                />
            </div>

            {{-- Featured Image --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5">
                <p class="mb-1 text-sm font-semibold text-slate-700">Featured Image</p>
                <p class="mb-3 text-xs text-slate-400">Main card/hero image for listings. Separate from the gallery.</p>

                <div
                    class="relative flex flex-col items-center justify-center rounded-xl border-2 border-dashed border-slate-200 bg-slate-50 p-5 text-center
                        hover:border-indigo-300 hover:bg-indigo-50/40 transition-colors cursor-pointer"
                    x-data="imagePreview()"
                    @click="$refs.fileInput.click()"
                    @dragover.prevent
                    @drop.prevent="handleDrop($event)"
                >
                    <div x-show="preview" class="mb-2 w-full">
                        <img :src="preview" alt="Preview" class="mx-auto h-32 w-full rounded-lg object-cover"/>
                        <p class="mt-1.5 text-[11px] text-indigo-600 font-medium">Click to change</p>
                    </div>
                    <template x-if="!preview">
                        <div class="flex flex-col items-center gap-1.5">
                            <svg class="h-7 w-7 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5z"/></svg>
                            <p class="text-xs font-medium text-slate-500">Click or drag image</p>
                            <p class="text-[10px] text-slate-400">JPG, PNG, WebP — max 2MB</p>
                        </div>
                    </template>
                    <input type="file" name="featured_image" accept="image/*" x-ref="fileInput" @change="handleChange($event)" class="sr-only"/>
                </div>
                @error('featured_image')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>

            {{-- Submit shortcut --}}
            <button type="submit" class="w-full inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 active:bg-indigo-800 transition-colors">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                Create Project
            </button>

        </div>
    </div>

</form>

@endsection

@push('scripts')
<script>
function projectForm() {
    return {
        title:      '{{ old('title') }}',
        slug:       '',
        status:     '{{ old('status', 'active') }}',
        isFeatured: {{ old('is_featured', '0') === '1' ? 'true' : 'false' }},
        generateSlug() {
            this.slug = this.title.toLowerCase().replace(/[^a-z0-9\s-]/g,'').trim().replace(/\s+/g,'-').replace(/-+/g,'-');
        },
        init() { if (this.title) this.generateSlug(); }
    }
}

function imagePreview() {
    return {
        preview: null,
        handleChange(e) { const f = e.target.files[0]; if (f) this.preview = URL.createObjectURL(f); },
        handleDrop(e) {
            const f = e.dataTransfer.files[0];
            if (f && f.type.startsWith('image/')) { this.$refs.fileInput.files = e.dataTransfer.files; this.preview = URL.createObjectURL(f); }
        }
    }
}

function galleryUpload() {
    return {
        previews: [],
        files: [],
        handleChange(e) {
            Array.from(e.target.files).forEach(f => {
                this.previews.push(URL.createObjectURL(f));
                this.files.push(f);
            });
        },
        handleDrop(e) {
            const dt = new DataTransfer();
            this.files.forEach(f => dt.items.add(f));
            Array.from(e.dataTransfer.files).forEach(f => {
                if (f.type.startsWith('image/')) {
                    dt.items.add(f);
                    this.previews.push(URL.createObjectURL(f));
                    this.files.push(f);
                }
            });
            this.$refs.galleryInput.files = dt.files;
        },
        removePreview(index) {
            this.previews.splice(index, 1);
            this.files.splice(index, 1);
            const dt = new DataTransfer();
            this.files.forEach(f => dt.items.add(f));
            this.$refs.galleryInput.files = dt.files;
        }
    }
}
</script>
@endpush