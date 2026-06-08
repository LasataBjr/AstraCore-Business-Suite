<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class TeamMemberController extends Controller
{
    public function index(Request $request)
    {
        $query = TeamMember::query();

        $query->when($request->filled('search'), function ($q) use ($request) {
            $search = $request->input('search');
            $q->where(function ($subQuery) use ($search) {
                $subQuery->where('name', 'like', "%{$search}%")
                        ->orWhere('designation', 'like', "%{$search}%")
                        ->orWhere('bio', 'like', "%{$search}%");
            });
        });

        $query->when($request->has('status') && $request->input('status') !== null && $request->input('status') !== '', function ($q) use ($request) {
            $q->where('status', $request->input('status'));
        });

        $members = $query->orderBy('sort_order')
                     ->latest()
                     ->paginate(10)
                     ->withQueryString();
                     
        return view('admin.team-members.index', compact('members'));
    }

    public function create()
    {
        return view('admin.team-members.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'facebook' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'status' => 'nullable|boolean',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('team', 'public');
        }

        TeamMember::create([
            'name' => $request->name,
            'designation' => $request->designation,
            'bio' => $request->bio,
            'image' => $imagePath,
            'facebook' => $request->facebook,
            'linkedin' => $request->linkedin,
            'sort_order' => 0,
            'status' => $request->boolean('status'),
        ]);

        return redirect()->route('admin.team-members.index')
            ->with('success', 'Team member created successfully');
    }

    public function edit(TeamMember $team_member)
    {
        return view('admin.team-members.edit', compact('team_member'));
    }

    public function update(Request $request, TeamMember $team_member)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'bio' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'facebook' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'status' => 'nullable|boolean',
        ]);

        $data = [
            'name' => $request->name,
            'designation' => $request->designation,
            'bio' => $request->bio,
            'facebook' => $request->facebook,
            'linkedin' => $request->linkedin,
            'status' => $request->boolean('status'),
        ];

        if ($request->hasFile('image')) {

            if ($team_member->image && Storage::disk('public')->exists($team_member->image)) {
                Storage::disk('public')->delete($team_member->image);
            }

            $data['image'] = $request->file('image')->store('team', 'public');
        }

        $team_member->update($data);

        return redirect()->route('admin.team-members.index')
            ->with('success', 'Team member updated successfully');
    }

    public function destroy(TeamMember $team_member)
    {
        if ($team_member->image) {
            Storage::disk('public')->delete($team_member->image);
        }

        $team_member->delete();

        return back()->with('success', 'Deleted successfully');
    }
}