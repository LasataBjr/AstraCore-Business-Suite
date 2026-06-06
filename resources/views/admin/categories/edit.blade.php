{{--
    Categories — Edit Page
    Path: resources/views/admin/categories/edit.blade.php
    Controller: App\Http\Controllers\Admin\CategoryController@edit / update

    NOTE: Delete action is a SEPARATE standalone form, completely
    outside the update <form> tag, placed below the main content.
--}}

@extends('layouts.admin')

@section('title', 'Edit: ' . $category->name)
@section('page-title', 'Categories')

@section('breadcrumb')
    <span class="text-slate-300">/</span>
    <a href="{{ route('admin.categories.index') }}" class="hover:text-indigo-600 transition-colors">All Categories</a>
    <span class="text-slate-300">/</span>
    <span class="text-slate-500 truncate max-w-[160px]">{{ Str::limit($category->name, 30) }}</span>
@endsection

@section('content')

{{-- ================================================================
     UPDATE FORM — wraps only the update fields, NOT the delete action
================================================================= --}}
<form
    method="POST"
    action="{{ route('admin.categories.update', $category) }}"
    x-data="categoryForm()"
    novalidate
>
    @csrf
    @method('PUT')

    {{-- ── PAGE HEADER ─────────────────────────────────────── --}}
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-xl font-bold text-slate-800 font-display">Edit Category</h2>
            <p class="mt-0.5 text-sm text-slate-500">
                Last updated {{ $category->updated_at->diffForHumans() }}
                · Created {{ $category->created_at->format('M j, Y') }}
            </p>
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
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                </svg>
                Save Changes
            </button>
        </div>
    </div>

    {{-- ── MAIN FORM GRID ──────────────────────────────────── --}}
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-5">

        {{-- ── LEFT: Core fields (2/3) ─────────────────────── --}}
        <div class="xl:col-span-2 space-y-5">

            {{-- Name + slug --}}
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
                        value="{{ old('name', $category->name) }}"
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
                    <p class="mt-1.5 text-xs text-slate-400">Changing the name will auto-update the slug.</p>
                </div>

                {{-- Slug preview --}}
                <div class="rounded-xl border border-slate-200 bg-slate-50 px-4 py-3">
                    <p class="mb-1 text-xs font-medium text-slate-500">Current URL slug</p>
                    <div class="flex items-center gap-2">
                        <svg class="h-3.5 w-3.5 text-slate-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244"/>
                        </svg>
                        <code class="text-sm font-mono text-indigo-600" x-text="slug"></code>
                    </div>
                    <p class="mt-1.5 text-[11px] text-slate-400">
                        Updated automatically when you change the name and save.
                    </p>
                </div>
            </div>

            {{-- Description --}}
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
                >{{ old('description', $category->description) }}</textarea>

                @error('description')
                    <p class="mt-1.5 flex items-center gap-1 text-xs text-red-600">
                        <svg class="h-3.5 w-3.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/></svg>
                        {{ $message }}
                    </p>
                @enderror

                <div class="mt-2 flex justify-end">
                    <span class="text-[11px] text-slate-400" x-text="description.length + ' characters'"></span>
                </div>
            </div>

            {{-- Usage summary --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-6">
                <h3 class="mb-4 text-sm font-semibold text-slate-700 flex items-center gap-2">
                    <span class="flex h-6 w-6 items-center justify-center rounded-md bg-slate-100">
                        <svg class="h-3.5 w-3.5 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"/>
                        </svg>
                    </span>
                    Usage in this category
                </h3>

                <div class="grid grid-cols-3 gap-3">
                    @php
                        $serviceCount = $category->services()->count();
                        $projectCount = $category->projects()->count();
                        $postCount    = $category->posts()->count();
                    @endphp

                    @foreach ([
                        ['Services',  $serviceCount, 'bg-violet-50', 'text-violet-700', 'border-violet-100'],
                        ['Projects',  $projectCount, 'bg-blue-50',   'text-blue-700',   'border-blue-100'],
                        ['Blog Posts',$postCount,    'bg-emerald-50','text-emerald-700','border-emerald-100'],
                    ] as [$label, $count, $bg, $text, $border])
                    <div class="rounded-xl border {{ $border }} {{ $bg }} px-3 py-3 text-center">
                        <p class="text-xl font-bold font-display {{ $text }}">{{ $count }}</p>
                        <p class="text-[11px] {{ $text }} opacity-80 mt-0.5">{{ $label }}</p>
                    </div>
                    @endforeach
                </div>

                @if ($serviceCount + $projectCount + $postCount > 0)
                <p class="mt-3 text-xs text-amber-600 flex items-start gap-1.5 bg-amber-50 rounded-xl px-3 py-2 border border-amber-100">
                    <svg class="h-3.5 w-3.5 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/>
                    </svg>
                    Deleting this category will affect {{ $serviceCount + $projectCount + $postCount }} linked item(s). Make sure to reassign them first.
                </p>
                @endif
            </div>

        </div>

        {{-- ── RIGHT: Settings sidebar (1/3) ────────────────── --}}
        <div class="space-y-5">

            {{-- Status --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5">
                <h3 class="mb-4 text-sm font-semibold text-slate-700">Status</h3>

                <div class="space-y-2" x-data="{ status: '{{ old('status', $category->status) }}' }">

                    {{-- Active --}}
                    <label
                        class="flex cursor-pointer items-center gap-3 rounded-xl border p-3.5 transition-all"
                        :class="status === 'active'
                            ? 'border-emerald-300 bg-emerald-50'
                            : 'border-slate-200 bg-slate-50 hover:border-slate-300'"
                    >
                        <input type="radio" name="status" value="active" x-model="status" class="hidden" />
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
                            <svg class="h-4 w-4 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                        </span>
                    </label>

                    {{-- Inactive --}}
                    <label
                        class="flex cursor-pointer items-center gap-3 rounded-xl border p-3.5 transition-all"
                        :class="status === 'inactive'
                            ? 'border-slate-400 bg-slate-100'
                            : 'border-slate-200 bg-slate-50 hover:border-slate-300'"
                    >
                        <input type="radio" name="status" value="inactive" x-model="status" class="hidden" />
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
                            <svg class="h-4 w-4 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
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

            {{-- Meta info --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5">
                <h3 class="mb-3 text-sm font-semibold text-slate-700">Details</h3>
                <dl class="space-y-2.5">
                    @foreach ([
                        ['ID',      '#' . $category->id],
                        ['Slug',    $category->slug],
                        ['Created', $category->created_at->format('M j, Y')],
                        ['Updated', $category->updated_at->format('M j, Y')],
                    ] as [$key, $val])
                    <div class="flex items-center justify-between gap-2">
                        <dt class="text-xs font-medium text-slate-500 flex-shrink-0">{{ $key }}</dt>
                        <dd class="text-xs text-slate-700 font-mono truncate text-right">{{ $val }}</dd>
                    </div>
                    @endforeach
                </dl>
            </div>

            {{-- Save button (sidebar shortcut) --}}
            <button
                type="submit"
                class="w-full inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 active:bg-indigo-800 transition-colors"
            >
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                </svg>
                Save Changes
            </button>

        </div>
    </div>

</form>
{{-- ================================================================
     END OF UPDATE FORM
================================================================= --}}


{{-- ================================================================
     DELETE SECTION — completely separate, outside the update form
     This is a standalone <form> with its own @csrf and @method DELETE
================================================================= --}}
<div class="mt-8">

    {{-- Divider --}}
    <div class="mb-5 flex items-center gap-3">
        <div class="flex-1 border-t border-slate-200"></div>
        <span class="flex-shrink-0 text-[11px] font-semibold uppercase tracking-widest text-slate-400">Danger Zone</span>
        <div class="flex-1 border-t border-slate-200"></div>
    </div>

    <div class="rounded-2xl border border-red-200 bg-red-50/50 p-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            {{-- Warning text --}}
            <div class="flex items-start gap-3">
                <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-xl bg-red-100">
                    <svg class="h-5 w-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-semibold text-red-800">Delete this category</p>
                    <p class="mt-0.5 text-xs text-red-600 max-w-md">
                        Permanently removes <strong>{{ $category->name }}</strong> and cannot be undone.
                        @php $total = $category->services()->count() + $category->projects()->count() + $category->posts()->count(); @endphp
                        @if ($total > 0)
                            This category is linked to <strong>{{ $total }} item(s)</strong> — reassign them before deleting.
                        @else
                            This category has no linked content and can be safely deleted.
                        @endif
                    </p>
                </div>
            </div>

            {{-- Standalone delete form — separate from update form --}}
            <form
                method="POST"
                action="{{ route('admin.categories.destroy', $category) }}"
                x-data
                @submit.prevent="if(confirm('Permanently delete «{{ addslashes($category->name) }}»?\n\nThis action cannot be undone.')) $el.submit()"
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
                    Delete Category
                </button>
            </form>

        </div>
    </div>
</div>
{{-- ================================================================
     END DELETE SECTION
================================================================= --}}

@endsection

@push('scripts')
<script>
function categoryForm() {
    return {
        name:        '{{ addslashes(old('name', $category->name)) }}',
        slug:        '{{ $category->slug }}',
        description: `{{ addslashes(old('description', $category->description ?? '')) }}`,

        generateSlug() {
            this.slug = this.name
                .toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .trim()
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');
        }
    }
}
</script>
@endpush