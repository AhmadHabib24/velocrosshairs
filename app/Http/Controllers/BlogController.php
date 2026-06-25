<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Tag;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Blog::with(['category', 'tags'])->where('status', 'published');

        if ($request->has('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        if ($request->has('tag')) {
            $query->whereHas('tags', function ($q) use ($request) {
                $q->where('slug', $request->tag);
            });
        }

        $blogs = $query->latest('published_at')->paginate(12);
        
        $categories = BlogCategory::where('status', 1)->whereHas('blogs', function($q) {
            $q->where('status', 'published');
        })->get();

        $tags = Tag::whereHas('blogs', function($q) {
            $q->where('status', 'published');
        })->get();

        return view('blogs.index', compact('blogs', 'categories', 'tags'));
    }

    public function show($slug)
    {
        $blog = Blog::with(['category', 'tags'])
                    ->where('slug', $slug)
                    ->where('status', 'published')
                    ->firstOrFail();

        $relatedBlogs = Blog::where('category_id', $blog->category_id)
                            ->where('id', '!=', $blog->id)
                            ->where('status', 'published')
                            ->latest('published_at')
                            ->take(3)
                            ->get();

        return view('blogs.show', compact('blog', 'relatedBlogs'));
    }
}
