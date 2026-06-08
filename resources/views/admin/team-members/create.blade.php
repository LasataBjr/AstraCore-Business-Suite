@extends('layouts.admin')

@section('title','Add Team Member')

@section('breadcrumb')
    <span class="text-slate-300">/</span>
    <a href="{{ route('admin.team-members.index') }}" class="hover:text-indigo-600 transition-colors">All Team Members</a>
    <span class="text-slate-300">/</span>
    <span class="text-slate-500">New Team Member</span>
@endsection

@section('content')

<form
    method="POST"
    action="{{ route('admin.team-members.store') }}"
    enctype="multipart/form-data"
    x-data="memberForm()"
    novalidate
>
    @csrf
 
    {{-- ── PAGE HEADER ─────────────────────────────────────── --}}
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-xl font-bold text-slate-800 font-display">Add Team Member</h2>
            <p class="mt-0.5 text-sm text-slate-500">Add a new person to your public-facing team page.</p>
        </div>
        <div class="flex items-center gap-2 flex-shrink-0">
            <a href="{{ route('admin.team-members.index') }}" class="rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-medium text-slate-600 hover:border-slate-300 hover:text-slate-800 transition-colors">Cancel</a>
            <button type="submit" class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 active:bg-indigo-800 transition-colors">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                </svg>
                Add Member
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
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
                        </svg>
                    </span>
                    Personal Details
                </h3>
 
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    {{-- Full Name --}}
                    <div>
                        <label for="name" class="block text-sm font-medium text-slate-700 mb-1.5">
                            Full Name <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
                                <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0"/>
                                </svg>
                            </div>
                            <input
                                type="text" id="name" name="name"
                                value="{{ old('name') }}"
                                placeholder="e.g. Sarah Johnson"
                                maxlength="255"
                                class="w-full rounded-xl border bg-slate-50 py-3 pl-10 pr-4 text-sm text-slate-800 placeholder-slate-400
                                    focus:bg-white focus:outline-none focus:ring-2 transition
                                    @error('name') border-red-300 bg-red-50 focus:border-red-400 focus:ring-red-100
                                    @else border-slate-200 focus:border-indigo-400 focus:ring-indigo-100 @enderror"
                            />
                        </div>
                        @error('name')<p class="mt-1.5 flex items-center gap-1 text-xs text-red-600"><svg class="h-3.5 w-3.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/></svg>{{ $message }}</p>@enderror
                    </div>
 
                    {{-- Designation --}}
                    <div>
                        <label for="designation" class="block text-sm font-medium text-slate-700 mb-1.5">
                            Job Title / Designation <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
                                <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                </svg>
                            </div>
                            <input
                                type="text" id="designation" name="designation"
                                value="{{ old('designation') }}"
                                placeholder="e.g. Lead Developer, UI Designer…"
                                maxlength="255"
                                class="w-full rounded-xl border bg-slate-50 py-3 pl-10 pr-4 text-sm text-slate-800 placeholder-slate-400
                                    focus:bg-white focus:outline-none focus:ring-2 transition
                                    @error('designation') border-red-300 bg-red-50 focus:border-red-400 focus:ring-red-100
                                    @else border-slate-200 focus:border-indigo-400 focus:ring-indigo-100 @enderror"
                            />
                        </div>
                        @error('designation')<p class="mt-1.5 flex items-center gap-1 text-xs text-red-600"><svg class="h-3.5 w-3.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"/></svg>{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>
 
            {{-- Bio --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-6">
                <h3 class="mb-4 flex items-center gap-2 text-sm font-semibold text-slate-700">
                    <span class="flex h-6 w-6 items-center justify-center rounded-md bg-indigo-100">
                        <svg class="h-3.5 w-3.5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25H12"/>
                        </svg>
                    </span>
                    Bio / Short Introduction
                    <span class="text-xs font-normal text-slate-400">(optional)</span>
                </h3>
                <textarea
                    id="bio" name="bio" rows="5"
                    x-model="bio"
                    placeholder="A short paragraph about this team member — their role, experience and skills…"
                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 placeholder-slate-400
                        focus:border-indigo-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-100 transition resize-y
                        @error('bio') border-red-300 bg-red-50 @enderror"
                >{{ old('bio') }}</textarea>
                <div class="mt-1.5 flex items-center justify-between">
                    @error('bio')<p class="text-xs text-red-600">{{ $message }}</p>@else<span></span>@enderror
                    <span class="text-[11px] text-slate-400" x-text="bio.length + ' chars'"></span>
                </div>
            </div>
 
            {{-- Social Links --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-6">
                <h3 class="mb-5 flex items-center gap-2 text-sm font-semibold text-slate-700">
                    <span class="flex h-6 w-6 items-center justify-center rounded-md bg-indigo-100">
                        <svg class="h-3.5 w-3.5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7.217 10.907a2.25 2.25 0 100 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186l9.566-5.314m-9.566 7.5l9.566 5.314m0 0a2.25 2.25 0 103.935 2.186 2.25 2.25 0 00-3.935-2.186zm0-12.814a2.25 2.25 0 103.933-2.185 2.25 2.25 0 00-3.933 2.185z"/>
                        </svg>
                    </span>
                    Social Links
                    <span class="text-xs font-normal text-slate-400">(optional)</span>
                </h3>
 
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    {{-- LinkedIn --}}
                    <div>
                        <label for="linkedin" class="mb-1.5 flex items-center gap-2 text-sm font-medium text-slate-700">
                            <span class="flex h-5 w-5 items-center justify-center rounded bg-blue-600 text-white text-[10px] font-bold flex-shrink-0">in</span>
                            LinkedIn URL
                        </label>
                        <input
                            type="url" id="linkedin" name="linkedin"
                            value="{{ old('linkedin') }}"
                            placeholder="https://linkedin.com/in/username"
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 placeholder-slate-400
                                focus:border-indigo-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-100 transition
                                @error('linkedin') border-red-300 bg-red-50 @enderror"
                        />
                        @error('linkedin')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
 
                    {{-- Facebook --}}
                    <div>
                        <label for="facebook" class="mb-1.5 flex items-center gap-2 text-sm font-medium text-slate-700">
                            <span class="flex h-5 w-5 items-center justify-center rounded bg-blue-600 text-white text-[10px] font-bold flex-shrink-0">f</span>
                            Facebook URL
                        </label>
                        <input
                            type="url" id="facebook" name="facebook"
                            value="{{ old('facebook') }}"
                            placeholder="https://facebook.com/username"
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 placeholder-slate-400
                                focus:border-indigo-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-100 transition
                                @error('facebook') border-red-300 bg-red-50 @enderror"
                        />
                        @error('facebook')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>
 
        </div>
 
        {{-- ═══════════════════════════════════════
             RIGHT — Sidebar (1/3)
        ═══════════════════════════════════════ --}}
        <div class="space-y-5">
 
            {{-- Visibility Status --}}
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
                    <div
                        class="relative flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full transition-colors duration-200"
                        :class="isVisible ? 'bg-emerald-500' : 'bg-slate-300'"
                        @click="isVisible = !isVisible"
                    >
                        <span
                            class="absolute top-0.5 left-0.5 h-5 w-5 rounded-full bg-white shadow-sm transition-transform duration-200"
                            :class="isVisible ? 'translate-x-5' : 'translate-x-0'"
                        ></span>
                    </div>
                    <input type="hidden" name="status" :value="isVisible ? '1' : '0'"/>
                </label>
 
                <div class="mt-3 flex items-center justify-between rounded-xl border border-slate-100 bg-slate-50 px-3 py-2 text-xs text-slate-500">
                    <span>Preview</span>
                    <span
                        x-text="isVisible ? 'Visible' : 'Hidden'"
                        :class="isVisible ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-500'"
                        class="inline-flex items-center gap-1.5 rounded-full px-2.5 py-0.5 text-[11px] font-semibold"
                    ></span>
                </div>
            </div>
 
            {{-- Profile Photo --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5">
                <p class="mb-1 text-sm font-semibold text-slate-700">Profile Photo</p>
                <p class="mb-3 text-xs text-slate-400">Square crop recommended. Max 2MB.</p>
 
                {{-- Drop zone --}}
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
                        <img :src="preview" alt="Preview" class="mx-auto h-32 w-32 rounded-full object-cover ring-4 ring-indigo-100"/>
                        <p class="mt-2 text-[11px] text-indigo-600 font-medium">Click to change</p>
                    </div>
 
                    <template x-if="!preview">
                        <div class="flex flex-col items-center gap-3">
                            <div class="flex h-20 w-20 items-center justify-center rounded-full bg-slate-200">
                                <svg class="h-8 w-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-slate-600">Click or drag photo here</p>
                                <p class="text-[10px] text-slate-400 mt-0.5">JPG, PNG, WebP — max 2MB</p>
                            </div>
                        </div>
                    </template>
 
                    <input type="file" name="image" accept="image/jpeg,image/png,image/webp" x-ref="fileInput" @change="handleChange($event)" class="sr-only"/>
                </div>
 
                @error('image')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
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
                        <p class="text-xs font-semibold text-indigo-800 mb-1">Display order</p>
                        <p class="text-xs text-indigo-700">Members are ordered by <code class="rounded bg-indigo-100 px-1">sort_order</code>. You can update the order from the edit page after creating.</p>
                    </div>
                </div>
            </div>
 
            {{-- Submit shortcut --}}
            <button type="submit" class="w-full inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 active:bg-indigo-800 transition-colors">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                Add Team Member
            </button>
 
        </div>
    </div>
 
</form>
 
@endsection
 
@push('scripts')
<script>
function memberForm() {
    return {
        bio:       '{{ old('bio') }}',
        isVisible: {{ old('status', '1') === '1' ? 'true' : 'false' }},
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