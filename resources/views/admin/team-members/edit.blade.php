@extends('layouts.admin')

@section('title','Edit Team Member')

@section('breadcrumb')
    <span class="text-slate-300">/</span>
    <a href="{{ route('admin.team-members.index') }}" class="hover:text-indigo-600 transition-colors">All Members</a>
    <span class="text-slate-300">/</span>
    <span class="text-slate-500 truncate max-w-[160px]">{{ Str::limit($team_member->name, 25) }}</span>
@endsection

@section('content')

{{-- ================================================================
     UPDATE FORM — only update fields inside, NO delete action
================================================================= --}}
<form
    method="POST"
    action="{{ route('admin.team-members.update', $team_member) }}"
    enctype="multipart/form-data"
    x-data="memberForm()"
    novalidate
>
    @csrf
    @method('PUT')
 
    {{-- ── PAGE HEADER ─────────────────────────────────────── --}}
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div class="flex items-center gap-3">
            {{-- Current avatar preview in header --}}
            <div class="h-11 w-11 flex-shrink-0 overflow-hidden rounded-xl border-2 border-indigo-100 bg-indigo-50">
                @if ($team_member->image)
                    <img src="{{ Storage::url($team_member->image) }}" alt="{{ $team_member->name }}" class="h-full w-full object-cover"/>
                @else
                    <div class="flex h-full w-full items-center justify-center text-base font-bold text-indigo-500 font-display">
                        {{ strtoupper(substr($team_member->name, 0, 1)) }}
                    </div>
                @endif
            </div>
            <div>
                <h2 class="text-xl font-bold text-slate-800 font-display">{{ $team_member->name }}</h2>
                <p class="mt-0.5 text-sm text-slate-500">{{ $team_member->designation }} · Updated {{ $team_member->updated_at->diffForHumans() }}</p>
            </div>
        </div>
        <div class="flex items-center gap-2 flex-shrink-0">
            <a href="{{ route('admin.team-members.index') }}" class="rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-medium text-slate-600 hover:border-slate-300 hover:text-slate-800 transition-colors">Cancel</a>
            <button type="submit" class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 active:bg-indigo-800 transition-colors">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                </svg>
                Save Changes
            </button>
        </div>
    </div>
 
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-5">
 
        {{-- ═══════════════════════════════════════
             LEFT — Main fields (2/3)
        ═══════════════════════════════════════ --}}
        <div class="xl:col-span-2 space-y-5">
 
            {{-- Name + Designation --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-6">
                <h3 class="mb-5 flex items-center gap-2 text-sm font-semibold text-slate-700">
                    <span class="flex h-6 w-6 items-center justify-center rounded-md bg-indigo-100">
                        <svg class="h-3.5 w-3.5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0"/>
                        </svg>
                    </span>
                    Personal Details
                </h3>
 
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    {{-- Full Name --}}
                    <div>
                        <label for="name" class="block text-sm font-medium text-slate-700 mb-1.5">Full Name <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
                                <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0"/></svg>
                            </div>
                            <input
                                type="text" id="name" name="name"
                                value="{{ old('name', $team_member->name) }}"
                                placeholder="e.g. Sarah Johnson"
                                maxlength="255"
                                class="w-full rounded-xl border bg-slate-50 py-3 pl-10 pr-4 text-sm text-slate-800 placeholder-slate-400
                                    focus:bg-white focus:outline-none focus:ring-2 transition
                                    @error('name') border-red-300 bg-red-50 focus:border-red-400 focus:ring-red-100
                                    @else border-slate-200 focus:border-indigo-400 focus:ring-indigo-100 @enderror"
                            />
                        </div>
                        @error('name')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
 
                    {{-- Designation --}}
                    <div>
                        <label for="designation" class="block text-sm font-medium text-slate-700 mb-1.5">Job Title / Designation <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
                                <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387"/></svg>
                            </div>
                            <input
                                type="text" id="designation" name="designation"
                                value="{{ old('designation', $team_member->designation) }}"
                                placeholder="e.g. Lead Developer, UI Designer…"
                                maxlength="255"
                                class="w-full rounded-xl border bg-slate-50 py-3 pl-10 pr-4 text-sm text-slate-800 placeholder-slate-400
                                    focus:bg-white focus:outline-none focus:ring-2 transition
                                    @error('designation') border-red-300 bg-red-50 focus:border-red-400 focus:ring-red-100
                                    @else border-slate-200 focus:border-indigo-400 focus:ring-indigo-100 @enderror"
                            />
                        </div>
                        @error('designation')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>
 
            {{-- Bio --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-6">
                <h3 class="mb-4 flex items-center gap-2 text-sm font-semibold text-slate-700">
                    <span class="flex h-6 w-6 items-center justify-center rounded-md bg-indigo-100">
                        <svg class="h-3.5 w-3.5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12"/></svg>
                    </span>
                    Bio / Short Introduction
                    <span class="text-xs font-normal text-slate-400">(optional)</span>
                </h3>
                <textarea
                    id="bio" name="bio" rows="5"
                    x-model="bio"
                    placeholder="A short paragraph about this team member…"
                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 placeholder-slate-400
                        focus:border-indigo-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-100 transition resize-y
                        @error('bio') border-red-300 bg-red-50 @enderror"
                >{{ old('bio', $team_member->bio) }}</textarea>
                <div class="mt-1.5 flex items-center justify-between">
                    @error('bio')<p class="text-xs text-red-600">{{ $message }}</p>@else<span></span>@enderror
                    <span class="text-[11px] text-slate-400" x-text="bio.length + ' chars'"></span>
                </div>
            </div>
 
            {{-- Social Links --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-6">
                <h3 class="mb-5 flex items-center gap-2 text-sm font-semibold text-slate-700">
                    <span class="flex h-6 w-6 items-center justify-center rounded-md bg-indigo-100">
                        <svg class="h-3.5 w-3.5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M7.217 10.907a2.25 2.25 0 100 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186l9.566-5.314m-9.566 7.5l9.566 5.314"/></svg>
                    </span>
                    Social Links
                    <span class="text-xs font-normal text-slate-400">(optional)</span>
                </h3>
 
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label for="linkedin" class="mb-1.5 flex items-center gap-2 text-sm font-medium text-slate-700">
                            <span class="flex h-5 w-5 items-center justify-center rounded bg-blue-600 text-white text-[10px] font-bold flex-shrink-0">in</span>
                            LinkedIn URL
                        </label>
                        <input type="url" id="linkedin" name="linkedin" value="{{ old('linkedin', $team_member->linkedin) }}"
                            placeholder="https://linkedin.com/in/username"
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 placeholder-slate-400
                                focus:border-indigo-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-100 transition
                                @error('linkedin') border-red-300 bg-red-50 @enderror"/>
                        @error('linkedin')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
 
                    <div>
                        <label for="facebook" class="mb-1.5 flex items-center gap-2 text-sm font-medium text-slate-700">
                            <span class="flex h-5 w-5 items-center justify-center rounded bg-blue-600 text-white text-[10px] font-bold flex-shrink-0">f</span>
                            Facebook URL
                        </label>
                        <input type="url" id="facebook" name="facebook" value="{{ old('facebook', $team_member->facebook) }}"
                            placeholder="https://facebook.com/username"
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 placeholder-slate-400
                                focus:border-indigo-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-100 transition
                                @error('facebook') border-red-300 bg-red-50 @enderror"/>
                        @error('facebook')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>
 
        </div>
 
        {{-- ═══════════════════════════════════════
             RIGHT — Sidebar (1/3)
        ═══════════════════════════════════════ --}}
        <div class="space-y-5">
 
            {{-- Visibility --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5">
                <h3 class="mb-4 text-sm font-semibold text-slate-700">Visibility</h3>
 
                <label class="flex cursor-pointer items-center justify-between gap-3 rounded-xl border px-4 py-3.5 transition-colors"
                    :class="isVisible ? 'border-emerald-300 bg-emerald-50' : 'border-slate-200 bg-slate-50 hover:border-slate-300'">
                    <div>
                        <p class="text-sm font-medium text-slate-700">Show on site</p>
                        <p class="text-xs mt-0.5" :class="isVisible ? 'text-emerald-600' : 'text-slate-400'">
                            <span x-text="isVisible ? 'Visible on the public team page' : 'Hidden from the public site'"></span>
                        </p>
                    </div>
                    <div class="relative flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full transition-colors duration-200"
                        :class="isVisible ? 'bg-emerald-500' : 'bg-slate-300'"
                        @click="isVisible = !isVisible">
                        <span class="absolute top-0.5 left-0.5 h-5 w-5 rounded-full bg-white shadow-sm transition-transform duration-200"
                            :class="isVisible ? 'translate-x-5' : 'translate-x-0'"></span>
                    </div>
                    <input type="hidden" name="status" :value="isVisible ? '1' : '0'"/>
                </label>
            </div>
 
            {{-- Sort Order --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5">
                <label for="sort_order" class="block text-sm font-semibold text-slate-700 mb-2">Display Order</label>
                <p class="text-xs text-slate-400 mb-3">Lower number = appears first on the team page.</p>
                <input
                    type="number" id="sort_order" name="sort_order"
                    value="{{ old('sort_order', $team_member->sort_order) }}"
                    min="0" max="999"
                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-2.5 text-sm text-slate-700 font-mono
                        focus:border-indigo-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-100 transition"
                />
            </div>
 
            {{-- Profile Photo --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5">
                <p class="mb-1 text-sm font-semibold text-slate-700">Profile Photo</p>
                <p class="mb-3 text-xs text-slate-400">Upload to replace current photo.</p>
 
                {{-- Current photo --}}
                @if ($team_member->image)
                <div class="mb-3 flex flex-col items-center group relative">
                    <img src="{{ Storage::url($team_member->image) }}" alt="Current photo"
                        class="h-28 w-28 rounded-full object-cover ring-4 ring-slate-100"/>
                    <p class="mt-2 text-xs text-slate-500">Current photo</p>
                </div>
                @endif
 
                <div
                    class="relative flex flex-col items-center justify-center rounded-xl border-2 border-dashed border-slate-200 bg-slate-50 p-5 text-center
                        hover:border-indigo-300 hover:bg-indigo-50/40 transition-colors cursor-pointer"
                    x-data="imagePreview()"
                    @click="$refs.fileInput.click()"
                    @dragover.prevent
                    @drop.prevent="handleDrop($event)"
                >
                    <div x-show="preview" class="mb-2">
                        <img :src="preview" class="mx-auto h-24 w-24 rounded-full object-cover ring-4 ring-indigo-100"/>
                        <p class="mt-2 text-[11px] text-indigo-600 font-medium">New photo selected</p>
                    </div>
                    <template x-if="!preview">
                        <div class="flex flex-col items-center gap-1.5">
                            <svg class="h-7 w-7 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/></svg>
                            <p class="text-xs font-medium text-slate-500">{{ $team_member->image ? 'Click to replace' : 'Click or drag' }}</p>
                            <p class="text-[10px] text-slate-400">JPG, PNG, WebP — max 2MB</p>
                        </div>
                    </template>
                    <input type="file" name="image" accept="image/jpeg,image/png,image/webp" x-ref="fileInput" @change="handleChange($event)" class="sr-only"/>
                </div>
                @error('image')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>
 
            {{-- Meta --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5">
                <h3 class="mb-3 text-sm font-semibold text-slate-700">Details</h3>
                <dl class="space-y-2.5">
                    @foreach ([
                        ['ID',      '#' . $team_member->id],
                        ['Order',   $team_member->sort_order],
                        ['Status',  $team_member->status ? 'Visible' : 'Hidden'],
                        ['Created', $team_member->created_at->format('M j, Y')],
                        ['Updated', $team_member->updated_at->format('M j, Y')],
                    ] as [$k, $v])
                    <div class="flex items-center justify-between gap-2">
                        <dt class="text-xs font-medium text-slate-500 flex-shrink-0">{{ $k }}</dt>
                        <dd class="text-xs text-slate-700 font-mono truncate text-right">{{ $v }}</dd>
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
                    <p class="text-sm font-semibold text-red-800">Remove team member</p>
                    <p class="mt-0.5 text-xs text-red-600 max-w-md">
                        Permanently removes <strong>{{ $team_member->name }}</strong>{{ $team_member->image ? ' and their profile photo' : '' }} from the site. This cannot be undone.
                    </p>
                </div>
            </div>
 
            {{-- Standalone delete form — OUTSIDE update form --}}
            <form
                method="POST"
                action="{{ route('admin.team-members.destroy', $team_member) }}"
                x-data
                @submit.prevent="if(confirm('Remove {{ addslashes($team_member->name) }} from the team?\n\nThis cannot be undone.')) $el.submit()"
                class="flex-shrink-0"
            >
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="inline-flex items-center gap-2 rounded-xl border border-red-300 bg-white px-5 py-2.5 text-sm font-semibold text-red-700
                        hover:bg-red-600 hover:text-white hover:border-red-600
                        focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>
                    Remove Member
                </button>
            </form>
 
        </div>
    </div>
</div>
 
@endsection
 
@push('scripts')
<script>
function memberForm() {
    return {
        bio:       `{{ addslashes(old('bio', $team_member->bio ?? '')) }}`,
        isVisible: {{ old('status', $team_member->status ? '1' : '0') === '1' ? 'true' : 'false' }},
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
</script>
@endpush