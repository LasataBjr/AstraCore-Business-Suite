@extends('layouts.admin')

@section('title', 'Create Category')

@section('content')

<h1 class="text-xl font-semibold mb-6">Create Category</h1>

<form method="POST" action="{{ route('admin.categories.store') }}"
      class="bg-white p-6 rounded-xl border space-y-4">
    @csrf

    <div>
        <label class="text-sm text-slate-600">Name</label>
        <input type="text" name="name"
               class="w-full border rounded-lg p-2 mt-1"
               placeholder="Category name">
        @error('name')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label class="text-sm text-slate-600">Description</label>
        <textarea name="description"
                  class="w-full border rounded-lg p-2 mt-1"
                  rows="4"></textarea>
    </div>

    <div>
        <label class="text-sm text-slate-600">Status</label>
        <select name="status" class="w-full border rounded-lg p-2 mt-1">
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
        </select>
    </div>

    <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg">
        Save Category
    </button>
</form>

@endsection