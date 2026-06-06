{{-- resources/views/admin/projects/_form.blade.php --}}

@php
    $project = $project ?? null;
@endphp

<div class="grid grid-cols-2 gap-4">

    {{-- Title --}}
    <div>
        <label>Title</label>
        <input type="text" name="title"
               value="{{ old('title', $project->title ?? '') }}"
               class="border p-2 w-full rounded">
    </div>

    {{-- Category --}}
    <div>
        <label>Category</label>
        <select name="category_id" class="border p-2 w-full rounded">
            <option value="">Select</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}"
                    @selected(old('category_id', $project->category_id ?? '') == $cat->id)>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Client --}}
    <div>
        <label>Client Name</label>
        <input type="text" name="client_name"
               value="{{ old('client_name', $project->client_name ?? '') }}"
               class="border p-2 w-full rounded">
    </div>

    {{-- URL --}}
    <div>
        <label>Project URL</label>
        <input type="url" name="project_url"
               value="{{ old('project_url', $project->project_url ?? '') }}"
               class="border p-2 w-full rounded">
    </div>

    {{-- Featured Image --}}
    <div>
        <label>Featured Image</label>
        <input type="file" name="featured_image" class="border p-2 w-full rounded">
    </div>

    {{-- Completion Date --}}
    <div>
        <label>Completion Date</label>
        <input type="date" name="completion_date"
               value="{{ old('completion_date', $project->completion_date ?? '') }}"
               class="border p-2 w-full rounded">
    </div>

    {{-- Featured --}}
    <div>
        <label>
            <input type="checkbox" name="is_featured"
                   {{ old('is_featured', $project->is_featured ?? false) ? 'checked' : '' }}>
            Featured Project
        </label>
    </div>

    {{-- Status --}}
    <div>
        <label>
            <input type="checkbox" name="status"
                   {{ old('status', $project->status ?? true) ? 'checked' : '' }}>
            Active
        </label>
    </div>

</div>

{{-- Description --}}
<div class="mt-4">
    <label>Description</label>
    <textarea name="description" rows="5"
              class="border p-2 w-full rounded">{{ old('description', $project->description ?? '') }}</textarea>
</div>

{{-- Gallery Images --}}
<div class="mt-4">
    <label>Project Images</label>
    <input type="file" name="images[]" multiple class="border p-2 w-full rounded">
</div>

{{-- Show existing featured image (edit mode) --}}
@if(isset($project) && $project->featured_image)
    <div class="mt-3">
        <img src="{{ asset('storage/' . $project->featured_image) }}"
             class="w-32 rounded">
    </div>
@endif