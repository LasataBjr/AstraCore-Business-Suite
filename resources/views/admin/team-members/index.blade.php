@extends('layouts.admin')

@section('title','Team Members')

@section('breadcrumb')
    <span class="text-slate-300">/</span>
    <span class="text-slate-500">All Team Members</span>
@endsection

@section('content')

<div class="flex justify-between mb-4">
    <h2 class="text-xl font-bold">Team Members</h2>

    <a href="{{ route('admin.team-members.create') }}"
       class="bg-indigo-600 text-white px-4 py-2 rounded-xl">
        Add Member
    </a>
</div>

<table class="w-full bg-white border rounded-xl overflow-hidden">
    <thead class="bg-slate-100 text-left text-sm">
        <tr>
            <th class="p-3">Image</th>
            <th>Name</th>
            <th>Designation</th>
            <th>Status</th>
            <th class="text-right p-3">Actions</th>
        </tr>
    </thead>

    <tbody>
        @foreach($members as $member)
        <tr class="border-t">
            <td class="p-3">
                @if($member->image)
                    <img src="{{ Storage::url($member->image) }}" class="h-10 w-10 rounded-full">
                @endif
            </td>

            <td>{{ $member->name }}</td>
            <td>{{ $member->designation }}</td>

            <td>
                @if($member->status)
                    <span class="text-green-600 text-sm">Active</span>
                @else
                    <span class="text-red-600 text-sm">Inactive</span>
                @endif
            </td>

            <td class="text-right p-3 space-x-2">
                <a href="{{ route('admin.team-members.edit',$member) }}"
                   class="text-indigo-600">Edit</a>

                <form method="POST"
                      action="{{ route('admin.team-members.destroy',$member) }}"
                      class="inline">
                    @csrf @method('DELETE')
                    <button class="text-red-600">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="mt-4">
    {{ $members->links() }}
</div>

@endsection