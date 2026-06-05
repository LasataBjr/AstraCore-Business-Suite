@extends('layouts.admin')

@section('title', 'Services')

@section('content')

<div class="flex items-center justify-between mb-6">
    <h2 class="text-xl font-bold">Services</h2>

    <a href="{{ route('admin.services.create') }}"
       class="bg-indigo-600 text-white px-4 py-2 rounded">
        + Add Service
    </a>
</div>

<div class="bg-white border rounded-xl overflow-hidden">

    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-left">
            <tr>
                <th class="p-3">Title</th>
                <th class="p-3">Category</th>
                <th class="p-3">Status</th>
                <th class="p-3">Featured</th>
                <th class="p-3 text-right">Actions</th>
            </tr>
        </thead>

        <tbody>
        @foreach($services as $service)
            <tr class="border-t">
                <td class="p-3 font-medium">{{ $service->title }}</td>

                <td class="p-3">
                    {{ $service->category->name ?? '-' }}
                </td>

                <td class="p-3">
                    <span class="px-2 py-1 text-xs rounded 
                        {{ $service->status === 'published' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                        {{ ucfirst($service->status) }}
                    </span>
                </td>

                <td class="p-3">
                    {{ $service->is_featured ? 'Yes' : 'No' }}
                </td>

                <td class="p-3 text-right space-x-2">
                    <a href="{{ route('admin.services.edit', $service) }}"
                       class="text-blue-600">Edit</a>

                    <form action="{{ route('admin.services.destroy', $service) }}"
                          method="POST"
                          class="inline"
                          onsubmit="return confirm('Delete this service?')">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-600">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

</div>

<div class="mt-4">
    {{ $services->links() }}
</div>

@endsection