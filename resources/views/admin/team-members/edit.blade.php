@extends('layouts.admin')

@section('title','Edit Team Member')

@section('breadcrumb')
    <span class="text-slate-300">/</span>
    <a href="{{ route('admin.team-members.index') }}" class="hover:text-indigo-600 transition-colors">All Team Members</a>
    <span class="text-slate-300">/</span>
    <span class="text-slate-500">Edit Team Member</span>
@endsection

@section('content')

<form method="POST"
      action="{{ route('admin.team-members.update',$team_member) }}"
      enctype="multipart/form-data">

@csrf
@method('PUT')

<div class="bg-white p-6 rounded-xl space-y-4">

    <input type="text" name="name"
           value="{{ $team_member->name }}"
           class="w-full border p-2 rounded">

    <input type="text" name="designation"
           value="{{ $team_member->designation }}"
           class="w-full border p-2 rounded">

    <textarea name="bio"
              class="w-full border p-2 rounded">{{ $team_member->bio }}</textarea>

    @if($team_member->image)
        <img src="{{ Storage::url($team_member->image) }}" class="h-16 rounded mb-2">
    @endif

    <input type="file" name="image" class="w-full">

    <input type="text" name="facebook"
           value="{{ $team_member->facebook }}"
           class="w-full border p-2 rounded">

    <input type="text" name="linkedin"
           value="{{ $team_member->linkedin }}"
           class="w-full border p-2 rounded">

    <label class="flex items-center gap-2">
        <input type="checkbox" name="status" value="1"
               {{ $team_member->status ? 'checked' : '' }}>
        Active
    </label>

    <button class="bg-indigo-600 text-white px-4 py-2 rounded">
        Update
    </button>

</div>

</form>

@endsection