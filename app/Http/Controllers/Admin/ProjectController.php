<?php
// featured image for main card or hero and project_images for full gallery / slider
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
    public function index()
    {
        $projects = Project::with('category')
            ->latest()
            ->paginate(10);

        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.projects.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'           => 'required|string|max:255',
            'category_id'     => 'nullable|exists:categories,id',
            'description'     => 'required|string',
            'status'          => 'required|in:active,inactive',
            'featured_image'  => 'nullable|image|max:2048',
            'images.*'        => 'nullable|image|max:2048', // gallery images
        ]);

        $featuredPath = null;

        if ($request->hasFile('featured_image')) {
            $featuredPath = $request->file('featured_image')->store('projects/featured', 'public');
        }

        $project = Project::create([
            'category_id'      => $request->category_id,
            'title'            => $request->title,
            'slug'             => Str::slug($request->title),
            'client_name'      => $request->client_name,
            'project_url'      => $request->project_url,
            'featured_image'   => $featuredPath,
            'description'      => $request->description,
            'completion_date'  => $request->completion_date,
            'is_featured'      => $request->boolean('is_featured'),
            'status'           => $request->status,
        ]);

        // Save multiple gallery images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('projects/gallery', 'public');

                $project->images()->create([
                    'image' => $path,
                    'sort_order' => $index,
                ]);
            }
        }

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project created successfully');
    }

    public function edit(Project $project)
    {
        $categories = Category::all();

        $project->load('images'); // important for gallery edit

        return view('admin.projects.edit', compact('project', 'categories'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title'           => 'required|string|max:255',
            'category_id'     => 'nullable|exists:categories,id',
            'description'     => 'required|string',
            'status'          => 'required|in:active,inactive',
            'featured_image'  => 'nullable|image|max:2048',
            'images.*'        => 'nullable|image|max:2048',
        ]);

        // slug logic (safe)
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
            'is_featured'     => $request->boolean('is_featured'),
            'status'          => $request->status,
        ];

        // replace featured image
        if ($request->hasFile('featured_image')) {
            if ($project->featured_image && Storage::disk('public')->exists($project->featured_image)) {
                Storage::disk('public')->delete($project->featured_image);
            }

            $data['featured_image'] = $request->file('featured_image')
                ->store('projects/featured', 'public');
        }

        $project->update($data);

        // add new gallery images (append only)
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('projects/gallery', 'public');

                $project->images()->create([
                    'image' => $path,
                    'sort_order' => $index,
                ]);
            }
        }

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project updated successfully');
    }

    public function destroy(Project $project)
    {
        // delete featured image
        if ($project->featured_image && Storage::disk('public')->exists($project->featured_image)) {
            Storage::disk('public')->delete($project->featured_image);
        }

        // delete gallery images
        foreach ($project->images as $img) {
            if (Storage::disk('public')->exists($img->image)) {
                Storage::disk('public')->delete($img->image);
            }
            $img->delete();
        }

        $project->delete();

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project deleted successfully');
    }
}