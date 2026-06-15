<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;


class ProjectPageController extends Controller
{
    /**
     * All Projects
     */
    public function index()
    {
        $projects = Project::with(['category'])
            ->where('status', 'active')
            ->latest()
            ->paginate(9);

        return view('public.projects.index', compact('projects'));
    }

    /**
     * Single Project
     */
    public function show($slug)
    {
        $project = Project::with(['category', 'images'])
            ->where('slug', $slug)
            ->where('status', 'active')
            ->firstOrFail();

        $relatedProjects = Project::where('id', '!=', $project->id)
            ->where('status', 'active')
            ->latest()
            ->take(3)
            ->get();

        return view('public.projects.show', compact(
            'project',
            'relatedProjects'
        ));
    }
}
