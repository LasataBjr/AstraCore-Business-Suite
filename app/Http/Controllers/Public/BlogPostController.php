<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogPost;
use App\Models\Category;
use App\Models\Tag;

class BlogPostController extends Controller
{
    public function index()
    {
        $blogs = BlogPost::with(['category', 'author', 'tags'])
            ->where('status', 'published')
            ->latest('published_at')
            ->paginate(9);

        $categories = Category::all();

        $tags = Tag::all();

        $recentPosts = BlogPost::where('status', 'published')
            ->latest('published_at')
            ->take(5)
            ->get();

        return view('public.blogposts.index', compact(
            'blogs',
            'categories',
            'tags',
            'recentPosts'
        ));
    }

     public function show($slug)
    {
        $blog = BlogPost::with([
            'category',
            'author',
            'tags'
        ])
        ->where('slug', $slug)
        ->where('status', 'published')
        ->firstOrFail();

        $relatedPosts = BlogPost::where('id', '!=', $blog->id)
            ->where('category_id', $blog->category_id)
            ->where('status', 'published')
            ->latest()
            ->take(3)
            ->get();

        return view('public.blogposts.show', compact(
            'blog',
            'relatedPosts'
        ));
    }
}
