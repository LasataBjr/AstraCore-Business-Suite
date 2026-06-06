@extends('layouts.admin')

@section('title', 'Site Settings')
@section('page-title', 'Site Settings')

@section('content')

<form method="POST"
      action="{{ route('admin.settings.update') }}"
      enctype="multipart/form-data">

    @csrf
    @method('PUT')

    {{-- PAGE HEADER --}}
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h2 class="text-xl font-bold text-slate-800">Website Settings</h2>
            <p class="text-sm text-slate-500">Manage your website identity and contact information</p>
        </div>

        <button type="submit"
                class="bg-indigo-600 text-white px-4 py-2 rounded-xl hover:bg-indigo-700">
            Save Settings
        </button>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- LEFT SIDE --}}
        <div class="lg:col-span-2 space-y-5">

            {{-- BASIC INFO --}}
            <div class="bg-white p-5 rounded-2xl border">
                <h3 class="font-semibold mb-4 text-slate-700">Basic Information</h3>

                <input type="text"
                       name="site_name"
                       value="{{ old('site_name', $settings->site_name ?? '') }}"
                       placeholder="Site Name"
                       class="w-full border rounded-lg p-2 mb-3">

                <input type="text"
                       name="tagline"
                       value="{{ old('tagline', $settings->tagline ?? '') }}"
                       placeholder="Tagline"
                       class="w-full border rounded-lg p-2 mb-3">

                <textarea name="footer_text"
                          placeholder="Footer Text"
                          class="w-full border rounded-lg p-2">
                    {{ old('footer_text', $settings->footer_text ?? '') }}
                </textarea>
            </div>

            {{-- CONTACT --}}
            <div class="bg-white p-5 rounded-2xl border">
                <h3 class="font-semibold mb-4 text-slate-700">Contact Information</h3>

                <input type="email"
                       name="email"
                       value="{{ old('email', $settings->email ?? '') }}"
                       placeholder="Email"
                       class="w-full border rounded-lg p-2 mb-3">

                <input type="text"
                       name="phone"
                       value="{{ old('phone', $settings->phone ?? '') }}"
                       placeholder="Phone"
                       class="w-full border rounded-lg p-2 mb-3">

                <textarea name="address"
                          placeholder="Address"
                          class="w-full border rounded-lg p-2">
                    {{ old('address', $settings->address ?? '') }}
                </textarea>
            </div>

            {{-- SOCIAL LINKS --}}
            <div class="bg-white p-5 rounded-2xl border">
                <h3 class="font-semibold mb-4 text-slate-700">Social Links</h3>

                <input type="text"
                       name="facebook"
                       value="{{ old('facebook', $settings->facebook ?? '') }}"
                       placeholder="Facebook URL"
                       class="w-full border rounded-lg p-2 mb-3">

                <input type="text"
                       name="linkedin"
                       value="{{ old('linkedin', $settings->linkedin ?? '') }}"
                       placeholder="LinkedIn URL"
                       class="w-full border rounded-lg p-2 mb-3">

                <input type="text"
                       name="instagram"
                       value="{{ old('instagram', $settings->instagram ?? '') }}"
                       placeholder="Instagram URL"
                       class="w-full border rounded-lg p-2">
            </div>

        </div>

        {{-- RIGHT SIDE --}}
        <div class="space-y-5">

            {{-- LOGO --}}
            <div class="bg-white p-5 rounded-2xl border">
                <h3 class="font-semibold mb-3">Logo</h3>

                @if(!empty($settings->logo))
                    <img src="{{ Storage::url($settings->logo) }}"
                         class="h-20 mx-auto mb-3 object-contain">
                @endif

                <input type="file" name="logo" class="w-full text-sm">
            </div>

            {{-- FAVICON --}}
            <div class="bg-white p-5 rounded-2xl border">
                <h3 class="font-semibold mb-3">Favicon</h3>

                @if(!empty($settings->favicon))
                    <img src="{{ Storage::url($settings->favicon) }}"
                         class="h-12 mx-auto mb-3">
                @endif

                <input type="file" name="favicon" class="w-full text-sm">
            </div>

            {{-- PREVIEW CARD --}}
            <div class="bg-slate-50 p-4 rounded-xl border text-xs text-slate-500">
                <p class="font-semibold mb-1">Note:</p>
                <p>These settings will be used globally across your website (header, footer, contact page).</p>
            </div>

        </div>

    </div>

</form>

@endsection