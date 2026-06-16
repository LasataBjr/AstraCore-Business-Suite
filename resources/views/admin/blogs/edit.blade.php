@extends('layouts.admin')
 
@section('title', 'Edit: ' . $blog->title)
@section('page-title', 'Blog Posts')
 
@section('breadcrumb')
    <span class="text-slate-300">/</span>
    <a href="{{ route('admin.blogs.index') }}" class="hover:text-indigo-600 transition-colors">All Posts</a>
    <span class="text-slate-300">/</span>
    <span class="text-slate-500 truncate max-w-[160px]">{{ Str::limit($blog->title, 30) }}</span>
@endsection
 
@section('content')
 
<form
    method="POST"
    action="{{ route('admin.blogs.update', $blog) }}"
    enctype="multipart/form-data"
    onsubmit="console.log('UPDATE FORM SUBMITTED')"
    x-data="blogForm()"
    novalidate
>
    @csrf
    @method('PUT')
 
    {{-- ── PAGE HEADER ─────────────────────────────────────── --}}
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-xl font-bold text-slate-800 font-display">Edit Post</h2>
            <p class="mt-0.5 text-sm text-slate-500">
                Last updated {{ $blog->updated_at->diffForHumans() }}
                @if ($blog->published_at)
                    · Published {{ $blog->published_at->format('M j, Y') }}
                @endif
            </p>
        </div>
        <div class="flex items-center gap-2 flex-shrink-0">
            {{-- Quick view on site --}}
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
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                </svg>
                Save Changes
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
                    value="{{ old('title', $blog->title) }}"
                    placeholder="Enter a clear, compelling title…"
                    x-model="title"
                    @input="generateSlug()"
                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 placeholder-slate-400 focus:border-indigo-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-100 transition @error('title') border-red-300 bg-red-50 @enderror"
                />
                @error('title')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
                <div class="mt-2 flex items-center gap-1.5 text-xs text-slate-400">
                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244"/>
                    </svg>
                    <span>Slug: <span class="font-medium text-indigo-500" x-text="slug"></span></span>
                </div>
            </div>
 
            {{-- Content --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5">
                <label for="content" class="block text-sm font-semibold text-slate-700 mb-2">
                    Content <span class="text-red-500">*</span>
                </label>

                <x-quill-editor id="content" name="content" :value="old('content', $blog->content)" />

                @error('content')
                    <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
 
            {{-- Excerpt --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5">
                <label for="excerpt" class="block text-sm font-semibold text-slate-700 mb-1">
                    Excerpt <span class="text-slate-400 font-normal text-xs">(optional)</span>
                </label>
                <textarea
                    id="excerpt"
                    name="excerpt"
                    rows="3"
                    placeholder="A short summary shown on blog listing pages…"
                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 placeholder-slate-400 focus:border-indigo-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-100 transition resize-y @error('excerpt') border-red-300 bg-red-50 @enderror"
                >{{ old('excerpt', $blog->excerpt) }}</textarea>
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
 
                <div class="mb-4">
                    <label for="status" class="block text-xs font-medium text-slate-600 mb-1.5">Status <span class="text-red-500">*</span></label>
                    <select
                        id="status"
                        name="status"
                        x-model="status"
                        class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-700 focus:border-indigo-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-100 transition @error('status') border-red-300 @enderror"
                    >
                        <option value="draft"     {{ old('status', $blog->status) === 'draft'     ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status', $blog->status) === 'published' ? 'selected' : '' }}>Published</option>
                        <option value="archived"  {{ old('status', $blog->status) === 'archived'  ? 'selected' : '' }}>Archived</option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
 
                <div x-show="status === 'published'" x-transition>
                    <label for="published_at" class="block text-xs font-medium text-slate-600 mb-1.5">Publish Date</label>
                    <input
                        type="datetime-local"
                        id="published_at"
                        name="published_at"
                        value="{{ old('published_at', $blog->published_at ? $blog->published_at->format('Y-m-d\TH:i') : now()->format('Y-m-d\TH:i')) }}"
                        class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-700 focus:border-indigo-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-100 transition"
                    />
                    @error('published_at')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
 
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
                        <option value="{{ $category->id }}" {{ old('category_id', $blog->category_id) == $category->id ? 'selected' : '' }}>
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
                    @php
                        $checked = in_array($tag->id, old('tags', $blog->tags->pluck('id')->toArray()));
                    @endphp
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
                            {{ $checked ? 'checked' : '' }}
                        />
                        {{ $tag->name }}
                    </label>
                    @endforeach
                </div>
            </div>
 
            {{-- Featured image --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5">
                <label class="block text-sm font-semibold text-slate-700 mb-3">Featured Image</label>
 
                {{-- Current image --}}
                @if ($blog->featured_image)
                <div class="mb-3 relative group">
                    <img
                        src="{{ Storage::url($blog->featured_image) }}"
                        alt="Current featured image"
                        class="h-36 w-full rounded-xl object-cover"
                    />
                    <div class="absolute inset-0 flex items-center justify-center rounded-xl bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity">
                        <p class="text-xs font-medium text-white">Upload new to replace</p>
                    </div>
                </div>
                @endif
 
                {{-- Drop zone --}}
                <div
                    class="relative flex flex-col items-center justify-center rounded-xl border-2 border-dashed border-slate-200 bg-slate-50 p-5 text-center hover:border-indigo-300 hover:bg-indigo-50/40 transition-colors cursor-pointer"
                    x-data="imagePreview()"
                    @click="$refs.fileInput.click()"
                    @dragover.prevent
                    @drop.prevent="handleDrop($event)"
                >
                    <div x-show="preview" class="mb-2 w-full">
                        <img :src="preview" alt="New image preview" class="mx-auto h-28 w-full rounded-lg object-cover" />
                        <p class="mt-1.5 text-[11px] text-indigo-600 font-medium">New image selected</p>
                    </div>
                    <template x-if="!preview">
                        <div class="flex flex-col items-center gap-1.5">
                            <svg class="h-6 w-6 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/>
                            </svg>
                            <p class="text-xs font-medium text-slate-500">{{ $blog->featured_image ? 'Click to replace image' : 'Click or drag to upload' }}</p>
                            <p class="text-[10px] text-slate-400">JPG, PNG, WebP — max 2MB</p>
                        </div>
                    </template>
                    <input
                        type="file"
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
        {{-- Danger zone --}}
            <div class="rounded-2xl border border-red-100 bg-red-50/50 p-5 w-[600px]">
                <h3 class="text-sm font-semibold text-red-700 mb-2">Danger Zone</h3>
                <p class="text-xs text-red-500 mb-3">Deleting this post is permanent and cannot be undone.</p>
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
                        class="inline-flex items-center gap-1.5 rounded-xl border border-red-200 bg-white px-4 py-2 text-sm font-medium text-red-600 hover:bg-red-600 hover:text-white hover:border-red-600 transition-all"
                    >
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                        </svg>
                        Delete This Post
                    </button>
                </form>
            </div>
 
@endsection
 
@push('scripts')
<script>
function blogForm() {
    return {
        title:        '{{ addslashes(old('title', $blog->title)) }}',
        slug:         '{{ addslashes($blog->slug) }}',
        status:       '{{ old('status', $blog->status) }}',
        selectedTags: {{ json_encode(array_map('intval', old('tags', $blog->tags->pluck('id')->toArray()))) }},
 
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