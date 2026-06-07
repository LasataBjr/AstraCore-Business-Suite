<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::with('category')
            ->latest()
            ->paginate(10);

        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $categories = Category::where('status', 'active')->get();

        return view('admin.services.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'icon' => 'nullable|string|max:100',
            'short_description' => 'nullable|string|max:255',
            'description' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_featured' => 'nullable|boolean',
            'status' => 'required|in:draft,published,archived',
        ]);

        // Image upload
        $imagePath = null;
        if ($request->hasFile('featured_image')) {
            $imagePath = $request->file('featured_image')->store('services', 'public');
        }

        $service = Service::create([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'icon' => $request->icon,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'featured_image' => $imagePath,
            'is_featured' => $request->boolean('is_featured'),
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Service created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        $service->load('category'); 

        return view('admin.services.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        $service = Service::findOrFail($service->id);
        $categories = Category::all();

        return view('admin.services.edit', compact('service', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'icon' => 'nullable|string|max:100',
            'short_description' => 'nullable|string|max:255',
            'description' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_featured' => 'nullable|boolean',
            'status' => 'required|in:draft,published',
        ]);

        // Generate slug if title has changed
        $slug = $service->title !== $request->title ? Str::slug($request->title) : $service->slug;

        $data = [
            'category_id'       => $request->category_id,
            'title'             => $request->title,
            'slug'              => $slug,
            'icon'              => $request->icon,
            'short_description' => $request->short_description,
            'description'       => $request->description,
            'is_featured'       => $request->boolean('is_featured'),
            'status'            => $request->status,
        ];

        // Handle image update
        if ($request->hasFile('featured_image')) {
            if ($service->featured_image && Storage::disk('public')->exists($service->featured_image)) {
                Storage::disk('public')->delete($service->featured_image);
            }

            $data['featured_image'] = $request->file('featured_image')
                ->store('services', 'public');
        }

        $service->update($data);

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Service updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        if ($service->featured_image && Storage::disk('public')->exists($service->featured_image)) {
            Storage::disk('public')->delete($service->featured_image);
        }

        $service->delete();

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Service deleted successfully');
    }
}
