@extends('layouts.admin')

@section('title','Add Team Member')

@section('breadcrumb')
    <span class="text-slate-300">/</span>
    <a href="{{ route('admin.team-members.index') }}" class="hover:text-indigo-600 transition-colors">All Team Members</a>
    <span class="text-slate-300">/</span>
    <span class="text-slate-500">New Team Member</span>
@endsection

@section('content')

<form method="POST" action="{{ route('admin.team-members.store') }}" enctype="multipart/form-data">
@csrf

<div class="bg-white p-6 rounded-xl space-y-4">

    <input type="text" name="name" placeholder="Name" class="w-full border p-2 rounded">

    <input type="text" name="designation" placeholder="Designation" class="w-full border p-2 rounded">

    <textarea name="bio" placeholder="Bio" class="w-full border p-2 rounded"></textarea>

    <input type="file" name="image" class="w-full">

    <input type="text" name="facebook" placeholder="Facebook URL" class="w-full border p-2 rounded">

    <input type="text" name="linkedin" placeholder="LinkedIn URL" class="w-full border p-2 rounded">

    <label class="flex items-center gap-2">
        <input type="checkbox" name="status" value="1">
        Active
    </label>

    <button class="bg-indigo-600 text-white px-4 py-2 rounded">
        Save
    </button>

</div>

</form>

@endsection