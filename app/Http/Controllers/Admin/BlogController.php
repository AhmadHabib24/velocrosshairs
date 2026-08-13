<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('category')->latest()->get();
        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        $categories = BlogCategory::where('status', 1)->get();
        $tags = Tag::all();
        return view('admin.blogs.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blogs,slug',
            'category_id' => 'required|exists:blog_categories,id',
            'content' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'status' => 'required|in:draft,published',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id'
        ]);

        $imagePath = $this->optimizeAndStoreImage($request->file('image'));

        $blog = Blog::create([
            'title' => $request->title,
            'slug' => $request->slug ? Str::slug($request->slug) : Str::slug($request->title),
            'category_id' => $request->category_id,
            'content' => $request->content,
            'image' => $imagePath,
            'status' => $request->status,
            'published_at' => $request->status === 'published' ? now() : null,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords
        ]);

        if ($request->has('tags')) {
            $blog->tags()->sync($request->tags);
        }

        return redirect()->route('admin.blogs.index')->with('success', 'Blog created successfully.');
    }

    public function edit(Blog $blog)
    {
        $categories = BlogCategory::where('status', 1)->get();
        $tags = Tag::all();
        return view('admin.blogs.edit', compact('blog', 'categories', 'tags'));
    }

    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blogs,slug,' . $blog->id,
            'category_id' => 'required|exists:blog_categories,id',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'status' => 'required|in:draft,published',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id'
        ]);

        $data = [
            'title' => $request->title,
            'slug' => $request->slug ? Str::slug($request->slug) : Str::slug($request->title),
            'category_id' => $request->category_id,
            'content' => $request->content,
            'status' => $request->status,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords
        ];

        if ($request->status === 'published' && $blog->status !== 'published') {
            $data['published_at'] = now();
        }

        if ($request->hasFile('image')) {
            if ($blog->image && Storage::disk('public')->exists($blog->image)) {
                Storage::disk('public')->delete($blog->image);
            }
            $data['image'] = $this->optimizeAndStoreImage($request->file('image'));
        }

        $blog->update($data);

        if ($request->has('tags')) {
            $blog->tags()->sync($request->tags);
        } else {
            $blog->tags()->detach();
        }

        return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully.');
    }

    private function optimizeAndStoreImage($file)
    {
        $info = @getimagesize($file->getRealPath());
        if (!$info) {
            return $file->store('blogs', 'public');
        }

        $width = $info[0];
        $height = $info[1];
        $mime = $info['mime'];

        $newWidth = $width;
        $newHeight = $height;
        if ($width > 800) {
            $newWidth = 800;
            $newHeight = (int)($height * (800 / $width));
        }

        $image = null;
        if ($mime == 'image/jpeg') $image = @imagecreatefromjpeg($file->getRealPath());
        elseif ($mime == 'image/png') $image = @imagecreatefrompng($file->getRealPath());
        elseif ($mime == 'image/webp') $image = @imagecreatefromwebp($file->getRealPath());

        if ($image) {
            $newImage = imagecreatetruecolor($newWidth, $newHeight);
            if ($mime == 'image/png' || $mime == 'image/webp') {
                imagealphablending($newImage, false);
                imagesavealpha($newImage, true);
                $transparent = imagecolorallocatealpha($newImage, 255, 255, 255, 127);
                imagefilledrectangle($newImage, 0, 0, $newWidth, $newHeight, $transparent);
            }

            imagecopyresampled($newImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
            
            $filename = Str::random(40) . '.webp';
            $dir = storage_path('app/public/blogs');
            
            if (!file_exists($dir)) {
                mkdir($dir, 0755, true);
            }
            
            $path = $dir . '/' . $filename;
            imagewebp($newImage, $path, 75);

            imagedestroy($image);
            imagedestroy($newImage);

            return 'blogs/' . $filename;
        }

        return $file->store('blogs', 'public');
    }

    public function destroy(Blog $blog)
    {
        if ($blog->image && Storage::disk('public')->exists($blog->image)) {
            Storage::disk('public')->delete($blog->image);
        }
        $blog->delete();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted successfully.');
    }
}
