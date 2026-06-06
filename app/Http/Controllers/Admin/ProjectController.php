<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Category;
use App\Models\ProjectImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * INDEX (LIST PROJECTS)
     */
    public function index(Request $request)
    {
        $query = Project::with(['category', 'images']);

        // SEARCH
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%")
                  ->orWhere('client_name', 'LIKE', "%{$search}%");
            });
        }

        // STATUS FILTER
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // FEATURED FILTER
        if ($request->filled('featured')) {
            $query->where('is_featured', $request->featured);
        }

        $projects = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * CREATE FORM
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.projects.create', compact('categories'));
    }

    /**
     * STORE PROJECT
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id'     => 'nullable|exists:categories,id',
            'title'           => 'required|string|max:255',
            'client_name'     => 'nullable|string|max:255',
            'project_url'     => 'nullable|url',
            'description'     => 'required',
            'completion_date' => 'nullable|date',
            'is_featured'     => 'boolean',
            'status'          => 'required|in:draft,published,archived',
            'featured_image'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // FEATURED IMAGE
        $featuredImage = null;
        if ($request->hasFile('featured_image')) {
            $featuredImage = $request->file('featured_image')->store('projects/featured', 'public');
        }

        // CREATE PROJECT
        $project = Project::create([
            'category_id'      => $request->category_id,
            'title'            => $request->title,
            'slug'             => Str::slug($request->title),
            'client_name'      => $request->client_name,
            'project_url'      => $request->project_url,
            'description'      => $request->description,
            'completion_date'  => $request->completion_date,
            'featured_image'   => $featuredImage,
            'is_featured'      => $request->is_featured ?? false,
            'status'           => $request->status ,
        ]);

        // GALLERY IMAGES
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('projects/gallery', 'public');

                ProjectImage::create([
                    'project_id' => $project->id,
                    'image'      => $path,
                    'sort_order' => $index,
                ]);
            }
        }

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Project created successfully');
    }

    /**
     * SHOW SINGLE PROJECT
     */
    public function show(Project $project)
    {
        $project->load(['category', 'images']);

        return view('admin.projects.show', compact('project'));
    }

    /**
     * EDIT FORM
     */
    public function edit(Project $project)
    {
        $categories = Category::all();

        return view('admin.projects.edit', compact('project', 'categories'));
    }

    /**
     * UPDATE PROJECT
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'client_name' => 'nullable|string|max:255',
            'project_url' => 'nullable|url',
            'description' => 'required|string',
            'completion_date' => 'nullable|date',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // SLUG LOGIC (same as blog)
        $slug = $project->title !== $request->title
            ? Str::slug($request->title)
            : $project->slug;

        $data = [
            'category_id'     => $request->category_id,
            'title'           => $request->title,
            'slug'            => $slug,
            'client_name'     => $request->client_name,
            'project_url'     => $request->project_url,
            'description'     => $request->description,
            'completion_date' => $request->completion_date,
            'is_featured'     => $request->is_featured ?? false,
            'status'          => $request->status ?? true,
        ];

        /**
         * FEATURED IMAGE UPDATE LOGIC
         */
        if ($request->hasFile('featured_image')) {

            if ($project->featured_image && Storage::disk('public')->exists($project->featured_image)) {
                Storage::disk('public')->delete($project->featured_image);
            }

            $data['featured_image'] = $request->file('featured_image')
                ->store('projects/featured', 'public');
        }

        $project->update($data);

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Project updated successfully');
    }

    /**
     * DELETE PROJECT
     */
    public function destroy(Project $project)
    {
        // delete gallery images
        foreach ($project->images as $img) {
            if (Storage::disk('public')->exists($img->image)) {
                Storage::disk('public')->delete($img->image);
            }
            $img->delete();
        }

        // delete featured image
        if ($project->featured_image && Storage::disk('public')->exists($project->featured_image)) {
            Storage::disk('public')->delete($project->featured_image);
        }

        $project->delete();

        return redirect()
            ->route('admin.projects.index')
            ->with('success', 'Project deleted successfully');
    }
}