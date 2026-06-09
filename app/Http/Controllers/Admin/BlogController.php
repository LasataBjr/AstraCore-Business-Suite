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
    public function index(Request $request)
    {
        $query = BlogPost::with(['author', 'category', 'tags']);

        // Search
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                ->orWhere('content', 'LIKE', "%{$search}%")
                ->orWhere('excerpt', 'LIKE', "%{$search}%");
            });
        }

        // Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $posts = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();


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
            'tags' => 'nullable|array',
           
        ]);

        // Image upload
        $imagePath = null;
        if ($request->hasFile('featured_image')) {
            $imagePath = $request->file('featured_image')->store('blog', 'public');
        }

        // Handle published_at logic
        $publishedAt = null;
        if ($request->status === 'published' && !$request->published_at) {
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
        $post->tags()->sync($request->input('tags', []));

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

        // Increment the views column cleanly without touching timestamps
        $blog->timestamps = false;
        $blog->increment('views');

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
            'tags' => 'nullable|array',
        ]);

        // preserve original slug unless title changed
        $slug = $blog->title !== $request->title
            ? Str::slug($request->title)
            : $blog->slug;

      
        $data = [
            'category_id'  => $request->category_id,
            'title'        => $request->title,
            'slug'         => $slug,
            'excerpt'      => Str::limit(strip_tags($request->content), 150),
            'content'      => $request->content,
            'status'       => $request->status,
            'published_at' => ($request->status === 'published' || !$blog->published_at) ? now() : $blog->published_at,
        ];

         /**
         *  published_at logic 
         * - If already published → keep original
         * - If switching draft → published → set now
         * - If manual date provided → use it
         */
        if ($request->status === 'published') {
            $data['published_at'] = $blog->published_at ?? now();
        } elseif ($request->filled('published_at')) {
            $data['published_at'] = $request->published_at;
        }

        //Handle image updates within the data structure cleanly
        if ($request->hasFile('featured_image')) {
            if ($blog->featured_image && Storage::disk('public')->exists($blog->featured_image)) {
                Storage::disk('public')->delete($blog->featured_image);
            }

            //  Add the newly uploaded image path directly into the data array
            $data['featured_image'] = $request->file('featured_image')->store('blog', 'public');
        }

        // Update using the unified dataset
        $blog->update($data);

        // Sync tags
        $blog->tags()->sync($request->input('tags', []));

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
