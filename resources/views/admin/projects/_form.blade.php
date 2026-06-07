{{-- To avoid duplicate code between create and editform so resuable form is used --}}

@php
    $project = $project ?? null;
@endphp

<div class="grid grid-cols-2 gap-4 bg-white p-5 rounded-xl border">

    {{-- Title --}}
    <input type="text"
           name="title"
           value="{{ old('title', $project->title ?? '') }}"
           placeholder="Project Title"
           class="border p-2 rounded">

    {{-- Category --}}
    <select name="category_id" class="border p-2 rounded">
        <option value="">Select Category</option>
        @foreach($categories as $cat)
            <option value="{{ $cat->id }}"
                {{ old('category_id', $project->category_id ?? '') == $cat->id ? 'selected' : '' }}>
                {{ $cat->name }}
            </option>
        @endforeach
    </select>

    {{-- Client --}}
    <input type="text"
           name="client_name"
           value="{{ old('client_name', $project->client_name ?? '') }}"
           placeholder="Client Name"
           class="border p-2 rounded">

    {{-- URL --}}
    <input type="url"
           name="project_url"
           value="{{ old('project_url', $project->project_url ?? '') }}"
           placeholder="Project URL"
           class="border p-2 rounded">

    {{-- Completion Date --}}
    <input type="date"
           name="completion_date"
           value="{{ old('completion_date', $project->completion_date ?? '') }}"
           class="border p-2 rounded">

    {{-- Featured --}}
    <label class="flex items-center gap-2">
        <input type="checkbox"
               name="is_featured"
               value="1"
               {{ old('is_featured', $project->is_featured ?? false) ? 'checked' : '' }}>
        Featured Project
    </label>

    {{-- Status --}}
    <select name="status" class="border p-2 rounded">
        <option value="active"
            {{ old('status', $project->status ?? '') == 'active' ? 'selected' : '' }}>
            Active
        </option>

        <option value="inactive"
            {{ old('status', $project->status ?? '') == 'inactive' ? 'selected' : '' }}>
            Inactive
        </option>
    </select>

    {{-- Description --}}
    <textarea name="description"
              class="border p-2 rounded col-span-2"
              rows="5"
              placeholder="Project Description">{{ old('description', $project->description ?? '') }}</textarea>

    {{-- Featured Image --}}
    <input type="file" name="featured_image" class="col-span-2">

    <button class="bg-indigo-600 text-white px-4 py-2 rounded col-span-2">
        Save Project
    </button>

</div>