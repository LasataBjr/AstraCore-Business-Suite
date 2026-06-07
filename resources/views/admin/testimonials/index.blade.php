@extends('layouts.admin')

@section('title', 'Testimonials')
@section('page-title', 'Testimonials')

@section('breadcrumb')
    <span class="text-slate-300">/</span>
    <span class="text-slate-500">All Testimonials</span>
@endsection

@section('content')

<div class="flex items-center justify-between mb-6">
    <div>
        <h2 class="text-xl font-bold text-slate-800">Testimonials</h2>
        <p class="text-sm text-slate-500">
            Manage client reviews and feedback.
        </p>
    </div>

    <a href="{{ route('admin.testimonials.create') }}"
       class="px-4 py-2 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700">
        + Add Testimonial
    </a>
</div>

<div class="bg-white rounded-2xl border overflow-hidden">

    <table class="w-full">
        <thead class="bg-slate-50">
        <tr>
            <th class="px-4 py-3 text-left">Client</th>
            <th class="px-4 py-3 text-left">Company</th>
            <th class="px-4 py-3 text-left">Rating</th>
            <th class="px-4 py-3 text-left">Status</th>
            <th class="px-4 py-3 text-right">Actions</th>
        </tr>
        </thead>

        <tbody>

        @forelse($testimonials as $testimonial)

            <tr class="border-t hover:bg-slate-50">

                <td class="px-4 py-4">
                    <div class="flex items-center gap-3">

                        @if($testimonial->image)
                            <img
                                src="{{ Storage::url($testimonial->image) }}"
                                class="h-10 w-10 rounded-full object-cover"
                            >
                        @else
                            <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-semibold">
                                {{ strtoupper(substr($testimonial->client_name,0,1)) }}
                            </div>
                        @endif

                        <div>
                            <div class="font-medium text-slate-800">
                                {{ $testimonial->client_name }}
                            </div>

                            <div class="text-xs text-slate-500">
                                {{ $testimonial->designation }}
                            </div>
                        </div>

                    </div>
                </td>

                <td class="px-4 py-4">
                    {{ $testimonial->company }}
                </td>

                <!-- //  -->
                <td class="px-4 py-4">
                    @for($i=1;$i<=5;$i++)
                        <!-- If the current star is less than or equal to the testimonial rating, show yellow star, otherwise show gray star   --> 
                        <span class="{{ $i <= $testimonial->rating ? 'text-yellow-500' : 'text-slate-300' }}">
                            ★
                        </span>
                    @endfor
                </td>

                <td class="px-4 py-4">

                    @if($testimonial->status)
                        <span class="px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs">
                            Active
                        </span>
                    @else
                        <span class="px-2 py-1 bg-red-100 text-red-700 rounded-full text-xs">
                            Inactive
                        </span>
                    @endif

                </td>

                <td class="px-4 py-4">
                    <div class="flex justify-end gap-2">

                        <a href="{{ route('admin.testimonials.edit',$testimonial) }}"
                           class="px-3 py-1 text-indigo-600 hover:text-indigo-800">
                            Edit
                        </a>

                        <form method="POST"
                              action="{{ route('admin.testimonials.destroy',$testimonial) }}">
                            @csrf
                            @method('DELETE')

                            <button
                                onclick="return confirm('Delete testimonial?')"
                                class="px-3 py-1 text-red-600 hover:text-red-800">
                                Delete
                            </button>
                        </form>

                    </div>
                </td>

            </tr>

        @empty

            <tr>
                <td colspan="5" class="text-center py-12 text-slate-400">
                    No testimonials found.
                </td>
            </tr>

        @endforelse

        </tbody>
    </table>

</div>

<div class="mt-4">
    {{ $testimonials->links() }}
</div>

@endsection