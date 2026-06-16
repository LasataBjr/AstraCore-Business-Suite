
@extends('layouts.admin')

@section('title', 'Edit: ' . $project->title)
@section('page-title', 'Projects')

@section('breadcrumb')
    <span class="text-slate-300">/</span>
    <a href="{{ route('admin.projects.index') }}" class="hover:text-indigo-600 transition-colors">All Projects</a>
    <span class="text-slate-300">/</span>
    <span class="text-slate-500 truncate max-w-[160px]">{{ Str::limit($project->title, 28) }}</span>
@endsection

@section('content')

{{-- ================================================================
     UPDATE FORM — only update fields inside, NO delete here
================================================================= --}}
<form
    method="POST"
    action="{{ route('admin.projects.update', $project) }}"
    enctype="multipart/form-data"
    x-data="projectForm()"
    novalidate
>
    @csrf
    @method('PUT')

    {{-- ── PAGE HEADER ─────────────────────────────────────── --}}
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-xl font-bold text-slate-800 font-display">Edit Project</h2>
            <p class="mt-0.5 text-sm text-slate-500">Last updated {{ $project->updated_at->diffForHumans() }} · Created {{ $project->created_at->format('M j, Y') }}</p>
        </div>
        <div class="flex items-center gap-2 flex-shrink-0">
            @if ($project->status === 'active')
            <a href="{{ url('/projects/' . $project->slug) }}" target="_blank"
                class="inline-flex items-center gap-1.5 rounded-xl border border-slate-200 bg-white px-3.5 py-2.5 text-sm font-medium text-slate-600 hover:border-slate-300 hover:text-slate-800 transition-colors">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                View Live
            </a>
            @endif
            <a href="{{ route('admin.projects.index') }}" class="rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-medium text-slate-600 hover:border-slate-300 hover:text-slate-800 transition-colors">Cancel</a>
            <button type="submit" class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 active:bg-indigo-800 transition-colors">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                Save Changes
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-5">

        {{-- ══════════════════════════════════════════
             LEFT — Main fields (2/3)
        ══════════════════════════════════════════ --}}
        <div class="xl:col-span-2 space-y-5">

            {{-- Title + Slug --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-6">
                <h3 class="mb-5 flex items-center gap-2 text-sm font-semibold text-slate-700">
                    <span class="flex h-6 w-6 items-center justify-center rounded-md bg-indigo-100">
                        <svg class="h-3.5 w-3.5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M6.429 9.75L2.25 12l4.179 2.25m0-4.5l5.571 3 5.571-3m-11.142 0L2.25 7.5 12 2.25l9.75 5.25-4.179 2.25"/></svg>
                    </span>
                    Project Identity
                </h3>

                <div class="mb-5">
                    <label for="title" class="block text-sm font-medium text-slate-700 mb-1.5">Project Title <span class="text-red-500">*</span></label>
                    <input
                        type="text" id="title" name="title"
                        value="{{ old('title', $project->title) }}"
                        placeholder="e.g. E-Commerce Platform…"
                        x-model="title" @input="generateSlug()" maxlength="255"
                        class="w-full rounded-xl border bg-slate-50 px-4 py-3 text-sm text-slate-800 placeholder-slate-400
                            focus:bg-white focus:outline-none focus:ring-2 transition
                            @error('title') border-red-300 bg-red-50 focus:border-red-400 focus:ring-red-100
                            @else border-slate-200 focus:border-indigo-400 focus:ring-indigo-100 @enderror"
                    />
                    @error('title')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
                    <p class="mt-1.5 text-xs text-slate-400">Changing the title will update the slug on save.</p>
                </div>

                <div class="rounded-xl border border-slate-200 bg-slate-50 px-4 py-3">
                    <p class="mb-1 text-xs font-medium text-slate-500">Current URL slug</p>
                    <div class="flex items-center gap-2">
                        <svg class="h-3.5 w-3.5 flex-shrink-0 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244"/></svg>
                        <code class="text-sm font-mono text-indigo-600" x-text="slug"></code>
                    </div>
                </div>
            </div>

            {{-- Client + URL --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-6">
                <h3 class="mb-5 flex items-center gap-2 text-sm font-semibold text-slate-700">
                    <span class="flex h-6 w-6 items-center justify-center rounded-md bg-indigo-100">
                        <svg class="h-3.5 w-3.5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/></svg>
                    </span>
                    Client & Project URL
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label for="client_name" class="block text-sm font-medium text-slate-700 mb-1.5">Client Name <span class="text-xs font-normal text-slate-400">(optional)</span></label>
                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
                                <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0"/></svg>
                            </div>
                            <input type="text" id="client_name" name="client_name" value="{{ old('client_name', $project->client_name) }}" placeholder="e.g. Acme Corp"
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 py-3 pl-10 pr-4 text-sm text-slate-800 placeholder-slate-400 focus:border-indigo-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-100 transition"/>
                        </div>
                    </div>
                    <div>
                        <label for="project_url" class="block text-sm font-medium text-slate-700 mb-1.5">Live Project URL <span class="text-xs font-normal text-slate-400">(optional)</span></label>
                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
                                <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                            </div>
                            <input type="url" id="project_url" name="project_url" value="{{ old('project_url', $project->project_url) }}" placeholder="https://client-project.com"
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 py-3 pl-10 pr-4 text-sm text-slate-800 placeholder-slate-400 focus:border-indigo-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-100 transition"/>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Description --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-6">
                <h3 class="mb-4 flex items-center gap-2 text-sm font-semibold text-slate-700">
                    <span class="flex h-6 w-6 items-center justify-center rounded-md bg-indigo-100">
                        <svg class="h-3.5 w-3.5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12"/></svg>
                    </span>
                    Description <span class="text-red-500">*</span>
                </h3>
                
                <x-quill-editor id="description" name="description" :value="old('description', $project->description)" />

                @error('description')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>

            {{-- Existing Gallery Images --}}
            @if ($project->images->isNotEmpty())
            <div class="rounded-2xl border border-slate-200 bg-white p-6">
                <h3 class="mb-1 flex items-center gap-2 text-sm font-semibold text-slate-700">
                    <span class="flex h-6 w-6 items-center justify-center rounded-md bg-indigo-100">
                        <svg class="h-3.5 w-3.5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909"/></svg>
                    </span>
                    Current Gallery ({{ $project->images->count() }} images)
                </h3>
                <p class="mb-4 text-xs text-slate-400">Hover an image and click × to delete it. New uploads are appended.</p>
                <div class="grid grid-cols-3 sm:grid-cols-4 gap-3">
                    @foreach ($project->images->sortBy('sort_order') as $img)
                    <div class="group relative">
                        <img src="{{ Storage::url($img->image) }}" alt="Gallery image {{ $loop->iteration }}"
                            class="h-24 w-full rounded-xl object-cover ring-1 ring-slate-200"/>
                        {{-- Delete individual gallery image --}}
                        <button type="submit"
                                form="delete-gallery-img-{{ $img->id }}"
                                class="absolute top-1.5 right-1.5 flex h-6 w-6 items-center justify-center rounded-full bg-red-500 text-white
                                    opacity-0 group-hover:opacity-100 transition-opacity shadow-sm hover:bg-red-600"
                                title="Remove image">
                            <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button> <!-- Binding attribute 'form' to the button to specify which form to submit on click -->
                        <p class="mt-1 text-center text-[10px] text-slate-400">#{{ $loop->iteration }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Add more gallery images --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-6">
                <h3 class="mb-1 flex items-center gap-2 text-sm font-semibold text-slate-700">
                    <span class="flex h-6 w-6 items-center justify-center rounded-md bg-indigo-100">
                        <svg class="h-3.5 w-3.5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                    </span>
                    Add More Gallery Images
                </h3>
                <p class="mb-4 text-xs text-slate-400">New images will be appended to the existing gallery.</p>

                <div
                    class="relative flex flex-col items-center justify-center rounded-xl border-2 border-dashed border-slate-200 bg-slate-50 p-8 text-center
                        hover:border-indigo-300 hover:bg-indigo-50/40 transition-colors cursor-pointer"
                    x-data="galleryUpload()"
                    @click="$refs.galleryInput.click()"
                    @dragover.prevent
                    @drop.prevent="handleDrop($event)"
                >
                    <div x-show="previews.length > 0" class="w-full mb-3">
                        <div class="grid grid-cols-3 sm:grid-cols-4 gap-2">
                            <template x-for="(src, i) in previews" :key="i">
                                <div class="relative group">
                                    <img :src="src" class="h-20 w-full rounded-lg object-cover"/>
                                    <button type="button" @click.stop="removePreview(i)"
                                        class="absolute top-1 right-1 flex h-5 w-5 items-center justify-center rounded-full bg-red-500 text-white opacity-0 group-hover:opacity-100 transition-opacity">
                                        <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                                    </button>
                                </div>
                            </template>
                        </div>
                        <p class="mt-2 text-xs font-medium text-indigo-600" x-text="previews.length + ' new image(s) to upload'"></p>
                    </div>
                    <template x-if="previews.length === 0">
                        <div class="flex flex-col items-center gap-2">
                            <svg class="h-10 w-10 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/></svg>
                            <p class="text-sm font-medium text-slate-500">Click or drag images here</p>
                            <p class="text-xs text-slate-400">Multiple images — max 2MB each</p>
                        </div>
                    </template>
                    <input type="file" name="images[]" multiple accept="image/*" x-ref="galleryInput" @change="handleChange($event)" class="sr-only"/>
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

                <div class="mb-4">
                    <label for="status" class="block text-xs font-medium text-slate-600 mb-1.5">Status <span class="text-red-500">*</span></label>
                    <select id="status" name="status" x-model="status"
                        class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-700
                            focus:border-indigo-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-100 transition">
                        <option value="active"   {{ old('status', $project->status) === 'active'   ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status', $project->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <div class="mb-4 flex items-center justify-between rounded-xl border border-slate-100 bg-slate-50 px-3 py-2.5 text-xs text-slate-500">
                    <span>Preview</span>
                    <span x-text="status === 'active' ? 'Active' : 'Inactive'"
                        :class="status === 'active' ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-500'"
                        class="inline-flex rounded-full px-2.5 py-0.5 text-[11px] font-semibold"></span>
                </div>

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
                        <option value="{{ $category->id }}" {{ old('category_id', $project->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Completion Date --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5">
                <label for="completion_date" class="block text-sm font-semibold text-slate-700 mb-3">Completion Date <span class="text-xs font-normal text-slate-400">(optional)</span></label>
                <input type="date" id="completion_date" name="completion_date"
                    value="{{ old('completion_date', $project->completion_date ? \Carbon\Carbon::parse($project->completion_date)->format('Y-m-d') : '') }}"
                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-700 focus:border-indigo-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-100 transition"/>
            </div>

            {{-- Featured Image --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5">
                <p class="mb-1 text-sm font-semibold text-slate-700">Featured Image</p>
                <p class="mb-3 text-xs text-slate-400">Main card/hero image. Separate from gallery.</p>

                @if ($project->featured_image)
                <div class="mb-3 group relative">
                    <img src="{{ Storage::url($project->featured_image) }}" alt="Current featured" class="h-32 w-full rounded-xl object-cover"/>
                    <div class="absolute inset-0 flex items-center justify-center rounded-xl bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity">
                        <p class="text-xs font-medium text-white">Upload to replace</p>
                    </div>
                </div>
                @endif

                <div class="relative flex flex-col items-center justify-center rounded-xl border-2 border-dashed border-slate-200 bg-slate-50 p-5 text-center
                    hover:border-indigo-300 hover:bg-indigo-50/40 transition-colors cursor-pointer"
                    x-data="imagePreview()"
                    @click="$refs.fileInput.click()"
                    @dragover.prevent
                    @drop.prevent="handleDrop($event)">
                    <div x-show="preview" class="mb-2 w-full">
                        <img :src="preview" class="mx-auto h-28 w-full rounded-lg object-cover"/>
                        <p class="mt-1.5 text-[11px] text-indigo-600 font-medium">New image selected</p>
                    </div>
                    <template x-if="!preview">
                        <div class="flex flex-col items-center gap-1.5">
                            <svg class="h-6 w-6 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/></svg>
                            <p class="text-xs font-medium text-slate-500">{{ $project->featured_image ? 'Click to replace' : 'Click or drag' }}</p>
                            <p class="text-[10px] text-slate-400">JPG, PNG, WebP — max 2MB</p>
                        </div>
                    </template>
                    <input type="file" name="featured_image" accept="image/*" x-ref="fileInput" @change="handleChange($event)" class="sr-only"/>
                </div>
                @error('featured_image')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>

            {{-- Meta --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5">
                <h3 class="mb-3 text-sm font-semibold text-slate-700">Details</h3>
                <dl class="space-y-2.5">
                    @foreach ([
                        ['ID',      '#' . $project->id],
                        ['Slug',    $project->slug],
                        ['Gallery', $project->images->count() . ' image(s)'],
                        ['Created', $project->created_at->format('M j, Y')],
                        ['Updated', $project->updated_at->format('M j, Y')],
                    ] as [$key, $val])
                    <div class="flex items-center justify-between gap-2">
                        <dt class="text-xs font-medium text-slate-500 flex-shrink-0">{{ $key }}</dt>
                        <dd class="text-xs text-slate-700 font-mono truncate text-right">{{ $val }}</dd>
                    </div>
                    @endforeach
                </dl>
            </div>

            {{-- Save shortcut --}}
            <button type="submit" class="w-full inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 active:bg-indigo-800 transition-colors">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                Save Changes
            </button>

        </div>
    </div>

</form>
{{-- END UPDATE FORM --}}


{{-- ================================================================
     DANGER ZONE — completely separate standalone form
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
                    <svg class="h-5 w-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/></svg>
                </div>
                <div>
                    <p class="text-sm font-semibold text-red-800">Delete this project</p>
                    <p class="mt-0.5 text-xs text-red-600 max-w-md">
                        Permanently deletes <strong>{{ $project->title }}</strong>, the featured image, and all
                        <strong>{{ $project->images->count() }} gallery image(s)</strong>. This cannot be undone.
                    </p>
                </div>
            </div>

            {{-- Standalone delete form — OUTSIDE update form --}}
            <form
                method="POST"
                action="{{ route('admin.projects.destroy', $project) }}"
                x-data
                @submit.prevent="if(confirm('Permanently delete «{{ addslashes($project->title) }}» and all its images?\n\nThis cannot be undone.')) $el.submit()"
                class="flex-shrink-0"
            >
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="inline-flex items-center gap-2 rounded-xl border border-red-300 bg-white px-5 py-2.5 text-sm font-semibold text-red-700
                        hover:bg-red-600 hover:text-white hover:border-red-600
                        focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
                    Delete Project
                </button>
            </form>

        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
function projectForm() {
    return {
        title:      '{{ addslashes(old('title', $project->title)) }}',
        slug:       '{{ $project->slug }}',
        status:     '{{ old('status', $project->status) }}',
        isFeatured: {{ old('is_featured', $project->is_featured ? '1' : '0') === '1' ? 'true' : 'false' }},
        generateSlug() {
            this.slug = this.title.toLowerCase().replace(/[^a-z0-9\s-]/g,'').trim().replace(/\s+/g,'-').replace(/-+/g,'-');
        }
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
        previews: [], files: [],
        handleChange(e) {
            Array.from(e.target.files).forEach(f => { this.previews.push(URL.createObjectURL(f)); this.files.push(f); });
        },
        handleDrop(e) {
            const dt = new DataTransfer();
            this.files.forEach(f => dt.items.add(f));
            Array.from(e.dataTransfer.files).forEach(f => {
                if (f.type.startsWith('image/')) { dt.items.add(f); this.previews.push(URL.createObjectURL(f)); this.files.push(f); }
            });
            this.$refs.galleryInput.files = dt.files;
        },
        removePreview(i) {
            this.previews.splice(i, 1); this.files.splice(i, 1);
            const dt = new DataTransfer();
            this.files.forEach(f => dt.items.add(f));
            this.$refs.galleryInput.files = dt.files;
        }
    }
}
</script>
@endpush