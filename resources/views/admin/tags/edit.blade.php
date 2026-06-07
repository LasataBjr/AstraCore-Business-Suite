@extends('layouts.admin')

@section('title', 'Edit Tag')

@section('breadcrumb')
    <span class="text-slate-300">/</span>
    <a href="{{ route('admin.tags.index') }}" class="hover:text-indigo-600 transition-colors">All Tags</a>
    <span class="text-slate-300">/</span>
    <span class="text-slate-500">Edit Tag</span>
@endsection

@section('content')

<div class="max-w-2xl">

    <h2 class="text-xl font-bold mb-6">
        Edit Tag
    </h2>

    <form method="POST"
          action="{{ route('admin.tags.update', $tag) }}"
          class="space-y-5">

        @csrf
        @method('PUT')

        <div>
            <label class="block mb-2">
                Tag Name
            </label>

            <input
                type="text"
                name="name"
                value="{{ old('name', $tag->name) }}"
                class="w-full border rounded-lg px-3 py-2"
            >
        </div>

        <button
            class="bg-indigo-600 text-white px-5 py-2 rounded-xl">
            Update Tag
        </button>

    </form>

</div>

@endsection