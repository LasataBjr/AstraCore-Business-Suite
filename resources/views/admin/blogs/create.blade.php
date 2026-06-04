@extends('layouts.admin')
 
@section('title', 'Create Blog Post')
@section('page-title', 'Blog Posts')
 
@section('breadcrumb')
    <span class="text-slate-300">/</span>
    <a href="{{ route('admin.blogs.index') }}" class="hover:text-indigo-600 transition-colors">All Posts</a>
    <span class="text-slate-300">/</span>
    <span class="text-slate-500">New Post</span>
@endsection
 
@section('content')
 
<form
    method="POST"
    action="{{ route('admin.blogs.store') }}"
    enctype="multipart/form-data"
    x-data="blogForm()"
    novalidate
>
    @csrf
 
    {{-- ── PAGE HEADER ─────────────────────────────────────── --}}
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-xl font-bold text-slate-800 font-display">New Blog Post</h2>
            <p class="mt-0.5 text-sm text-slate-500">Fill in the details below and publish when ready.</p>
        </div>
        <div class="flex items-center gap-2 flex-shrink-0">
            <a
                href="{{ route('admin.blogs.index') }}"
                class="rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-medium text-slate-600 hover:border-slate-300 hover:text-slate-800 transition-colors"
            >
                Cancel
            </a>
            <button
                type="submit"
                class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-indigo-700 active:bg-indigo-800 transition-colors"
            >
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                </svg>
                Publish Post
            </button>
        </div>
    </div>
 
    {{-- ── TWO-COLUMN LAYOUT ───────────────────────────────── --}}
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-5">
 
        {{-- ── LEFT: Main content (2/3) ─────────────────── --}}
        <div class="xl:col-span-2 space-y-5">
 
            {{-- Title --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5">
                <label for="title" class="block text-sm font-semibold text-slate-700 mb-2">
                    Post Title <span class="text-red-500">*</span>
                </label>
                <input
                    type="text"
                    id="title"
                    name="title"
                    value="{{ old('title') }}"
                    placeholder="Enter a clear, compelling title…"
                    x-model="title"
                    @input="generateSlug()"
                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 placeholder-slate-400 focus:border-indigo-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-100 transition @error('title') border-red-300 bg-red-50 @enderror"
                />
                @error('title')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
 
                {{-- Auto slug preview --}}
                <div class="mt-2 flex items-center gap-1.5 text-xs text-slate-400">
                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244"/>
                    </svg>
                    <span>Slug: <span class="font-medium text-indigo-500" x-text="slug || 'auto-generated-from-title'"></span></span>
                </div>
            </div>
 
            {{-- Content --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5">
                <label for="content" class="block text-sm font-semibold text-slate-700 mb-2">
                    Content <span class="text-red-500">*</span>
                </label>
 
                {{-- Simple toolbar hint --}}
                <div class="mb-2 flex flex-wrap gap-1.5">
                    @foreach(['B','I','U','H1','H2','UL','OL','Link'] as $tool)
                    <button
                        type="button"
                        class="rounded border border-slate-200 bg-slate-50 px-2 py-1 text-[11px] font-semibold text-slate-500 hover:bg-slate-100 hover:text-slate-700 transition-colors"
                    >{{ $tool }}</button>
                    @endforeach
                    <span class="text-[10px] text-slate-400 self-center ml-1">— Install a rich-text editor (e.g. TinyMCE / Trix) and attach to #content</span>
                </div>
 
                <textarea
                    id="content"
                    name="content"
                    rows="16"
                    placeholder="Write your blog post content here…"
                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 placeholder-slate-400 focus:border-indigo-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-100 transition resize-y @error('content') border-red-300 bg-red-50 @enderror"
                >{{ old('content') }}</textarea>
                @error('content')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
 
            {{-- Excerpt (optional override) --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5">
                <label for="excerpt" class="block text-sm font-semibold text-slate-700 mb-1">
                    Excerpt <span class="text-slate-400 font-normal text-xs">(optional — auto-generated from content if left blank)</span>
                </label>
                <textarea
                    id="excerpt"
                    name="excerpt"
                    rows="3"
                    placeholder="A short summary shown on blog listing pages…"
                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 placeholder-slate-400 focus:border-indigo-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-100 transition resize-y @error('excerpt') border-red-300 bg-red-50 @enderror"
                >{{ old('excerpt') }}</textarea>
                @error('excerpt')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
 
        </div>
 
        {{-- ── RIGHT: Settings sidebar (1/3) ────────────── --}}
        <div class="space-y-5">
 
            {{-- Publish settings --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5">
                <h3 class="text-sm font-semibold text-slate-700 mb-4">Publish Settings</h3>
 
                {{-- Status --}}
                <div class="mb-4">
                    <label for="status" class="block text-xs font-medium text-slate-600 mb-1.5">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <select
                        id="status"
                        name="status"
                        x-model="status"
                        class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-700 focus:border-indigo-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-100 transition @error('status') border-red-300 @enderror"
                    >
                        <option value="draft"     {{ old('status','draft') === 'draft'     ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status')         === 'published' ? 'selected' : '' }}>Published</option>
                        <option value="archived"  {{ old('status')         === 'archived'  ? 'selected' : '' }}>Archived</option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
 
                {{-- Published at --}}
                <div x-show="status === 'published'" x-transition>
                    <label for="published_at" class="block text-xs font-medium text-slate-600 mb-1.5">
                        Publish Date
                    </label>
                    <input
                        type="datetime-local"
                        id="published_at"
                        name="published_at"
                        value="{{ old('published_at', now()->format('Y-m-d\TH:i')) }}"
                        class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-700 focus:border-indigo-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-100 transition"
                    />
                    @error('published_at')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
 
                {{-- Status badge preview --}}
                <div class="mt-4 pt-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
                    <span>Preview:</span>
                    <span
                        x-text="status === 'published' ? 'Published' : status === 'draft' ? 'Draft' : 'Archived'"
                        :class="{
                            'bg-emerald-100 text-emerald-700': status === 'published',
                            'bg-amber-100 text-amber-700':    status === 'draft',
                            'bg-slate-100 text-slate-500':    status === 'archived'
                        }"
                        class="inline-flex rounded-full px-2.5 py-0.5 text-[11px] font-semibold"
                    ></span>
                </div>
            </div>
 
            {{-- Category --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5">
                <label for="category_id" class="block text-sm font-semibold text-slate-700 mb-3">
                    Category <span class="text-red-500">*</span>
                </label>
                <select
                    id="category_id"
                    name="category_id"
                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-700 focus:border-indigo-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-100 transition @error('category_id') border-red-300 @enderror"
                >
                    <option value="">Select a category…</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
 
            {{-- Tags --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5">
                <label class="block text-sm font-semibold text-slate-700 mb-3">Tags</label>
                <div class="flex flex-wrap gap-2">
                    @foreach ($tags as $tag)
                    <label
                        class="flex cursor-pointer items-center gap-1.5 rounded-full border px-3 py-1 text-xs font-medium transition-colors"
                        :class="selectedTags.includes({{ $tag->id }})
                            ? 'border-indigo-300 bg-indigo-50 text-indigo-700'
                            : 'border-slate-200 bg-slate-50 text-slate-600 hover:border-slate-300'"
                    >
                        <input
                            type="checkbox"
                            name="tags[]"
                            value="{{ $tag->id }}"
                            class="sr-only"
                            x-model="selectedTags"
                            {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}
                        />
                        {{ $tag->name }}
                    </label>
                    @endforeach
                </div>
                @if ($tags->isEmpty())
                    <p class="text-xs text-slate-400 mt-2">No tags found. <a href="#" class="text-indigo-600 hover:underline">Create tags →</a></p>
                @endif
            </div>
 
            {{-- Featured image --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5">
                <label class="block text-sm font-semibold text-slate-700 mb-3">Featured Image</label>
 
                {{-- Drop zone --}}
                <div
                    class="relative flex flex-col items-center justify-center rounded-xl border-2 border-dashed border-slate-200 bg-slate-50 p-6 text-center hover:border-indigo-300 hover:bg-indigo-50/40 transition-colors cursor-pointer"
                    x-data="imagePreview()"
                    @click="$refs.fileInput.click()"
                    @dragover.prevent
                    @drop.prevent="handleDrop($event)"
                >
                    {{-- Preview --}}
                    <div x-show="preview" class="mb-3 w-full">
                        <img :src="preview" alt="Preview" class="mx-auto h-32 w-full rounded-lg object-cover" />
                    </div>
 
                    <template x-if="!preview">
                        <div class="flex flex-col items-center gap-2">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-200">
                                <svg class="h-5 w-5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/>
                                </svg>
                            </div>
                            <p class="text-xs font-medium text-slate-600">Click or drag to upload</p>
                            <p class="text-[11px] text-slate-400">JPG, PNG, WebP — max 2MB</p>
                        </div>
                    </template>
 
                    <input
                        type="file"
                        id="featured_image"
                        name="featured_image"
                        accept="image/*"
                        x-ref="fileInput"
                        @change="handleChange($event)"
                        class="sr-only"
                    />
                </div>
 
                @error('featured_image')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
 
        </div>{{-- end right --}}
    </div>{{-- end grid --}}
 
</form>
 
@endsection
 
@push('scripts')
<script>
function blogForm() {
    return {
        title:        '{{ old('title') }}',
        slug:         '',
        status:       '{{ old('status', 'draft') }}',
        selectedTags: {{ json_encode(array_map('intval', old('tags', []))) }},
 
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
        handleChange(event) {
            const file = event.target.files[0];
            if (file) this.preview = URL.createObjectURL(file);
        },
        handleDrop(event) {
            const file = event.dataTransfer.files[0];
            if (file) {
                this.$refs.fileInput.files = event.dataTransfer.files;
                this.preview = URL.createObjectURL(file);
            }
        }
    }
}
</script>
@endpush