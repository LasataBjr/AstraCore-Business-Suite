

@extends('layouts.admin')

@section('title', 'Add Testimonial')
@section('page-title', 'Testimonials')

@section('breadcrumb')
    <span class="text-slate-300">/</span>
    <a href="{{ route('admin.testimonials.index') }}" class="hover:text-indigo-600 transition-colors">All Testimonials</a>
    <span class="text-slate-300">/</span>
    <span class="text-slate-500">New Testimonial</span>
@endsection

@section('content')

<form
    method="POST"
    action="{{ route('admin.testimonials.store') }}"
    enctype="multipart/form-data"
    x-data="testimonialForm()"
    novalidate
>
    @csrf

    {{-- ── PAGE HEADER ─────────────────────────────────────── --}}
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-xl font-bold text-slate-800 font-display">New Testimonial</h2>
            <p class="mt-0.5 text-sm text-slate-500">Add a client review to display on your public site.</p>
        </div>
        <div class="flex items-center gap-2 flex-shrink-0">
            <a href="{{ route('admin.testimonials.index') }}" class="rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-medium text-slate-600 hover:border-slate-300 hover:text-slate-800 transition-colors">Cancel</a>
            <button type="submit" class="inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 active:bg-indigo-800 transition-colors">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                Save Testimonial
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-5">

        {{-- ═══════════════════════════════════════════
             LEFT — Main content (2/3)
        ═══════════════════════════════════════════ --}}
        <div class="xl:col-span-2 space-y-5">

            {{-- Client Identity --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-6">
                <h3 class="mb-5 flex items-center gap-2 text-sm font-semibold text-slate-700">
                    <span class="flex h-6 w-6 items-center justify-center rounded-md bg-indigo-100">
                        <svg class="h-3.5 w-3.5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0"/>
                        </svg>
                    </span>
                    Client Information
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                    {{-- Client Name --}}
                    <div class="sm:col-span-2">
                        <label for="client_name" class="block text-sm font-medium text-slate-700 mb-1.5">
                            Client Name <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
                                <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0"/></svg>
                            </div>
                            <input
                                type="text" id="client_name" name="client_name"
                                value="{{ old('client_name') }}"
                                placeholder="e.g. James Carter"
                                maxlength="255"
                                class="w-full rounded-xl border bg-slate-50 py-3 pl-10 pr-4 text-sm text-slate-800 placeholder-slate-400
                                    focus:bg-white focus:outline-none focus:ring-2 transition
                                    @error('client_name') border-red-300 bg-red-50 focus:border-red-400 focus:ring-red-100
                                    @else border-slate-200 focus:border-indigo-400 focus:ring-indigo-100 @enderror"
                            />
                        </div>
                        @error('client_name')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>

                    {{-- Designation --}}
                    <div>
                        <label for="designation" class="block text-sm font-medium text-slate-700 mb-1.5">
                            Job Title / Designation <span class="text-xs font-normal text-slate-400">(optional)</span>
                        </label>
                        <input
                            type="text" id="designation" name="designation"
                            value="{{ old('designation') }}"
                            placeholder="e.g. CEO, Marketing Director…"
                            maxlength="255"
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 placeholder-slate-400
                                focus:border-indigo-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-100 transition
                                @error('designation') border-red-300 bg-red-50 @enderror"
                        />
                        @error('designation')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>

                    {{-- Company --}}
                    <div>
                        <label for="company" class="block text-sm font-medium text-slate-700 mb-1.5">
                            Company <span class="text-xs font-normal text-slate-400">(optional)</span>
                        </label>
                        <div class="relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3.5">
                                <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21"/></svg>
                            </div>
                            <input
                                type="text" id="company" name="company"
                                value="{{ old('company') }}"
                                placeholder="e.g. TechCorp Inc."
                                maxlength="255"
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 py-3 pl-10 pr-4 text-sm text-slate-800 placeholder-slate-400
                                    focus:border-indigo-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-100 transition
                                    @error('company') border-red-300 bg-red-50 @enderror"
                            />
                        </div>
                        @error('company')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
                    </div>

                </div>
            </div>

            {{-- Review Text --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-6">
                <h3 class="mb-4 flex items-center gap-2 text-sm font-semibold text-slate-700">
                    <span class="flex h-6 w-6 items-center justify-center rounded-md bg-indigo-100">
                        <svg class="h-3.5 w-3.5 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z"/>
                        </svg>
                    </span>
                    Review <span class="text-red-500">*</span>
                </h3>

                {{-- Live preview quote --}}
                <div x-show="review.length > 0"
                    class="mb-4 rounded-xl border border-indigo-100 bg-indigo-50/60 px-4 py-3">
                    <p class="text-sm text-slate-600 italic leading-relaxed" x-text="'\"' + review + '\"'"></p>
                </div>

                <textarea
                    id="review" name="review" rows="6"
                    x-model="review"
                    placeholder="Write the client's review or testimonial here — in their own words…"
                    class="w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-800 placeholder-slate-400
                        focus:border-indigo-400 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-100 transition resize-y
                        @error('review') border-red-300 bg-red-50 @enderror"
                >{{ old('review') }}</textarea>

                <div class="mt-1.5 flex items-center justify-between">
                    @error('review')<p class="text-xs text-red-600">{{ $message }}</p>@else<span></span>@enderror
                    <span class="text-[11px] text-slate-400" x-text="review.length + ' chars'"></span>
                </div>
            </div>

            {{-- Star Rating --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-6">
                <h3 class="mb-4 flex items-center gap-2 text-sm font-semibold text-slate-700">
                    <span class="flex h-6 w-6 items-center justify-center rounded-md bg-amber-100">
                        <svg class="h-3.5 w-3.5 text-amber-600" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    </span>
                    Star Rating <span class="text-red-500">*</span>
                </h3>

                {{-- Interactive star picker --}}
                <div class="flex items-center gap-3">
                    <div class="flex items-center gap-1" x-data>
                        @for ($i = 1; $i <= 5; $i++)
                        <button
                            type="button"
                            @click="rating = {{ $i }}"
                            @mouseenter="hoverRating = {{ $i }}"
                            @mouseleave="hoverRating = 0"
                            class="transition-transform hover:scale-110 focus:outline-none"
                            title="{{ $i }} star{{ $i > 1 ? 's' : '' }}"
                        >
                            <svg class="h-9 w-9 transition-colors"
                                :class="(hoverRating || rating) >= {{ $i }} ? 'text-amber-400' : 'text-slate-200'"
                                fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        </button>
                        @endfor
                    </div>

                    {{-- Rating label --}}
                    <div class="min-w-[80px]">
                        <p class="text-sm font-semibold text-slate-700" x-text="ratingLabel"></p>
                        <p class="text-xs text-slate-400" x-text="rating + '/5 stars'"></p>
                    </div>
                </div>

                <input type="hidden" name="rating" :value="rating"/>
                @error('rating')<p class="mt-2 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>

        </div>

        {{-- ═══════════════════════════════════════════
             RIGHT — Sidebar (1/3)
        ═══════════════════════════════════════════ --}}
        <div class="space-y-5">

            {{-- Visibility --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5">
                <h3 class="mb-4 text-sm font-semibold text-slate-700">Visibility</h3>

                <label class="flex cursor-pointer items-center justify-between gap-3 rounded-xl border px-4 py-3.5 transition-colors"
                    :class="isVisible ? 'border-emerald-300 bg-emerald-50' : 'border-slate-200 bg-slate-50 hover:border-slate-300'">
                    <div>
                        <p class="text-sm font-medium text-slate-700">Show on site</p>
                        <p class="text-xs mt-0.5" :class="isVisible ? 'text-emerald-600' : 'text-slate-400'">
                            <span x-text="isVisible ? 'Displayed on the public testimonials section' : 'Hidden from visitors'"></span>
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

            {{-- Preview card --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5">
                <p class="mb-3 text-sm font-semibold text-slate-700">Live Preview</p>
                <div class="rounded-xl border border-slate-100 bg-slate-50 p-4">
                    {{-- Stars preview --}}
                    <div class="mb-3 flex items-center gap-0.5">
                        @for ($i = 1; $i <= 5; $i++)
                        <svg class="h-4 w-4 transition-colors"
                            :class="rating >= {{ $i }} ? 'text-amber-400' : 'text-slate-200'"
                            fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        @endfor
                    </div>
                    {{-- Quote --}}
                    <p class="text-xs text-slate-600 italic leading-relaxed mb-3"
                        x-text="review.length > 0 ? '\"' + review.substring(0,90) + (review.length > 90 ? '…\"' : '\"') : '\"Your review will appear here…\"'"></p>
                    {{-- Author --}}
                    <div class="flex items-center gap-2">
                        <div class="h-8 w-8 flex-shrink-0 rounded-full bg-indigo-100 flex items-center justify-center text-xs font-bold text-indigo-600 uppercase" id="previewInitial">?</div>
                        <div>
                            <p class="text-xs font-semibold text-slate-700" id="previewName">Client Name</p>
                            <p class="text-[10px] text-slate-400" id="previewRole">Designation, Company</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Client Photo --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5">
                <p class="mb-1 text-sm font-semibold text-slate-700">Client Photo</p>
                <p class="mb-3 text-xs text-slate-400">Square crop recommended. Max 2MB.</p>

                <div
                    class="relative flex flex-col items-center justify-center rounded-xl border-2 border-dashed border-slate-200 bg-slate-50 p-5 text-center
                        hover:border-indigo-300 hover:bg-indigo-50/40 transition-colors cursor-pointer"
                    x-data="imagePreview()"
                    @click="$refs.fileInput.click()"
                    @dragover.prevent
                    @drop.prevent="handleDrop($event)"
                >
                    <div x-show="preview" class="mb-3 w-full">
                        <img :src="preview" alt="Preview" class="mx-auto h-24 w-24 rounded-full object-cover ring-4 ring-indigo-100"/>
                        <p class="mt-2 text-[11px] text-indigo-600 font-medium">Click to change</p>
                    </div>
                    <template x-if="!preview">
                        <div class="flex flex-col items-center gap-2">
                            <div class="flex h-16 w-16 items-center justify-center rounded-full bg-slate-200">
                                <svg class="h-7 w-7 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0"/></svg>
                            </div>
                            <p class="text-xs font-medium text-slate-500">Click or drag photo</p>
                            <p class="text-[10px] text-slate-400">JPG, PNG, WebP — max 2MB</p>
                        </div>
                    </template>
                    <input type="file" name="image" accept="image/jpeg,image/png,image/webp" x-ref="fileInput" @change="handleChange($event)" class="sr-only"/>
                </div>
                @error('image')<p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>@enderror
            </div>

            {{-- Submit shortcut --}}
            <button type="submit" class="w-full inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 active:bg-indigo-800 transition-colors">
                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                Save Testimonial
            </button>

        </div>
    </div>

</form>

@endsection

@push('scripts')
<script>
function testimonialForm() {
    return {
        review:      '{{ old('review') }}',
        rating:      {{ old('rating', 5) }},
        hoverRating: 0,
        isVisible:   {{ old('status', '1') === '1' ? 'true' : 'false' }},

        get ratingLabel() {
            const labels = {1:'Poor',2:'Fair',3:'Good',4:'Very Good',5:'Excellent'};
            return labels[this.hoverRating || this.rating] || 'Select rating';
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

// Live preview updates for name / role
const nameInput       = document.getElementById('client_name');
const designationInput = document.getElementById('designation');
const companyInput    = document.getElementById('company');
const previewName     = document.getElementById('previewName');
const previewRole     = document.getElementById('previewRole');
const previewInitial  = document.getElementById('previewInitial');

function updatePreview() {
    const name  = nameInput?.value || 'Client Name';
    const desig = designationInput?.value || '';
    const comp  = companyInput?.value || '';
    const role  = [desig, comp].filter(Boolean).join(', ') || 'Designation, Company';
    if (previewName) previewName.textContent = name;
    if (previewRole) previewRole.textContent = role;
    if (previewInitial) previewInitial.textContent = name.charAt(0).toUpperCase() || '?';
}

[nameInput, designationInput, companyInput].forEach(el => el?.addEventListener('input', updatePreview));
updatePreview();
</script>
@endpush