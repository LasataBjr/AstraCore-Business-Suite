@extends('layouts.admin')

@section('title','Edit Testimonial')
@section('page-title','Edit Testimonial')

@section('breadcrumb')
    <span class="text-slate-300">/</span>
    <a href="{{ route('admin.testimonials.index') }}" class="hover:text-indigo-600 transition-colors">All Testimonials</a>
    <span class="text-slate-300">/</span>
    <span class="text-slate-500">Edit Testimonial</span>
@endsection

@section('content')

<form method="POST"
      action="{{ route('admin.testimonials.update',$testimonial) }}"
      enctype="multipart/form-data">

    @csrf
    @method('PUT')

    <div class="bg-white rounded-2xl border p-6 space-y-5">

        <div>
            <label class="block text-sm font-medium mb-2">
                Client Name
            </label>

            <input type="text"
                   name="client_name"
                   value="{{ old('client_name',$testimonial->client_name) }}"
                   class="w-full border rounded-xl p-3">
        </div>

        <div>
            <label class="block text-sm font-medium mb-2">
                Company
            </label>

            <input type="text"
                   name="company"
                   value="{{ old('company',$testimonial->company) }}"
                   class="w-full border rounded-xl p-3">
        </div>

        <div>
            <label class="block text-sm font-medium mb-2">
                Designation
            </label>

            <input type="text"
                   name="designation"
                   value="{{ old('designation',$testimonial->designation) }}"
                   class="w-full border rounded-xl p-3">
        </div>

        <div>
            <label class="block text-sm font-medium mb-2">
                Review
            </label>

            <textarea
                name="review"
                rows="6"
                class="w-full border rounded-xl p-3">{{ old('review',$testimonial->review) }}</textarea>
        </div>

        <div>
            <label class="block text-sm font-medium mb-2">
                Rating
            </label>

            <select name="rating"
                    class="w-full border rounded-xl p-3">

                @for($i=5;$i>=1;$i--)
                    <option value="{{ $i }}"
                        {{ $testimonial->rating == $i ? 'selected' : '' }}>
                        {{ $i }} Star
                    </option>
                @endfor

            </select>
        </div>

        @if($testimonial->image)

            <div>
                <img
                    src="{{ Storage::url($testimonial->image) }}"
                    class="h-20 w-20 rounded-xl object-cover">
            </div>

        @endif

        <div>
            <label class="block text-sm font-medium mb-2">
                Change Photo
            </label>

            <input type="file" name="image">
        </div>

        <div>
            <label class="flex items-center gap-2">

                <input
                    type="checkbox"
                    name="status"
                    value="1"
                    {{ $testimonial->status ? 'checked' : '' }}>

                Active

            </label>
        </div>

        <div>
            <button
                class="px-5 py-3 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700">

                Update Testimonial

            </button>
        </div>

    </div>

</form>

@endsection