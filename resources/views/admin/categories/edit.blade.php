@extends('layouts.admin')

@section('title', 'Edit Category')

@section('content')

<h1 class="text-xl font-semibold mb-6">Edit Category</h1>

<form method="POST"
      action="{{ route('admin.categories.update', $category) }}"
      class="bg-white p-6 rounded-xl border space-y-4">

    @csrf
    @method('PUT')

    <div>
        <label class="text-sm text-slate-600">Name</label>
        <input type="text" name="name"
               value="{{ $category->name }}"
               class="w-full border rounded-lg p-2 mt-1">
    </div>

    <div>
        <label class="text-sm text-slate-600">Description</label>
        <textarea name="description"
                  class="w-full border rounded-lg p-2 mt-1"
                  rows="4">{{ $category->description }}</textarea>
    </div>

    <div>
        <label class="text-sm text-slate-600">Status</label>
        <select name="status" class="w-full border rounded-lg p-2 mt-1">
            <option value="active" {{ $category->status == 'active' ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ $category->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
        </select>
    </div>

    <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg">
        Update Category
    </button>

</form>

@endsection