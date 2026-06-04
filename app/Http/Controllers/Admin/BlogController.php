<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * INDEX (LIST POSTS)
     */
    public function index()
    {
        $posts = BlogPost::with(['author', 'category','tags'])
                ->latest()
                ->paginate(10);

        return view('admin.blogs.index', compact('posts'));
    }

    /**
     * CREATE FORM
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.blogs.create', compact('categories', 'tags'));
    }

    /**
     * STORE POST
     */
    public function store(Request $request)
    {
         $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:draft,published,archived',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'published_at' => 'nullable|date',
           
        ]);

        // Image upload
        $imagePath = null;
        if ($request->hasFile('featured_image')) {
            $imagePath = $request->file('featured_image')->store('blog', 'public');
        }

        // Handle published_at logic
        $publishedAt = null;
        if ($request->status === 'published' || !$request->published_at) {
            $publishedAt = $request->published_at ?? now();
        }

        // Create post
        $post = BlogPost::create([
            'user_id' => auth()->id(),
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'excerpt' => Str::limit(strip_tags($request->content), 150),
            'content' => $request->content,
            'featured_image' => $imagePath,
            'status' => $request->status,
            'published_at' => $publishedAt, // Only set published_at if status is published
        ]);

        // Attach tags
        if ($request->tags) {
            $post->tags()->sync($request->tags);
        }

        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'Blog post created successfully');
    }

    /**
     * SHOW SINGLE POST
     */
    public function show(BlogPost $blog)
    {
        $blog->load(['category', 'author', 'tags']); // Eager load relationships for better performance

        return view('admin.blogs.show', compact('blog'));
    }

    /**
     * EDIT FORM
     */
    public function edit(BlogPost $blog)
    {
        $categories = Category::all(); // For category dropdown
        $tags = Tag::all(); // For tags multi-select

        return view('admin.blogs.edit', compact('blog', 'categories', 'tags'));
    }

    /**
     * UPDATE POST
     */
    public function update(Request $request, BlogPost $blog)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|in:draft,published,archived',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'published_at' => 'nullable|date',
        ]);

        // Image update
        if ($request->hasFile('featured_image')) {

            if ($blog->featured_image && Storage::disk('public')->exists($blog->featured_image)) {
                Storage::disk('public')->delete($blog->featured_image);
            }

            $blog->featured_image = $request->file('featured_image')
                ->store('blog', 'public');
        }

        // Handle published_at logic
        $publishedAt = $blog->published_at;
        if ($request->status === 'published' || !$publishedAt) { // If status is published or published_at is not set, set published_at to now
            $publishedAt = now();
        } 

        $blog->update([ 
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'excerpt' => Str::limit(strip_tags($request->content), 150),
            'content' => $request->content,
            'status' => $request->status,
            'published_at' => $publishedAt, 
        ]);

        // Sync tags
        $blog->tags()->sync($request->tags ?? []);

        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'Blog post updated successfully');
    }

    /**
     *  DELETE POST
     */
    public function destroy(BlogPost $blog)
    {
        if ($blog->featured_image && Storage::disk('public')->exists($blog->featured_image)) {
            Storage::disk('public')->delete($blog->featured_image);
        }

        $blog->tags()->detach(); // Detach all tags before deleting the post
        $blog->delete();

        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'Blog post deleted successfully');
    }
}
