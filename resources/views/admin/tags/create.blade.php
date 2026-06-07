@extends('layouts.admin')

@section('title', 'Create Tag')

@section('breadcrumb')
    <span class="text-slate-300">/</span>
    <a href="{{ route('admin.tags.index') }}" class="hover:text-indigo-600 transition-colors">All Tags</a>
    <span class="text-slate-300">/</span>
    <span class="text-slate-500">New Tag</span>
@endsection

@section('content')

<div class="max-w-2xl">

    <h2 class="text-xl font-bold mb-6">
        Create Tag
    </h2>

    <form method="POST"
          action="{{ route('admin.tags.store') }}"
          class="space-y-5">

        @csrf

        <div>
            <label class="block mb-2">
                Tag Name
            </label>

            <input
                type="text"
                name="name"
                value="{{ old('name') }}"
                class="w-full border rounded-lg px-3 py-2"
            >
        </div>

        <button
            class="bg-indigo-600 text-white px-5 py-2 rounded-xl">
            Save Tag
        </button>

    </form>

</div>

@endsection