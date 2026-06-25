<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BackgroundImage;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class BackgroundImagesController extends Controller
{
    // List all background images
    public function index()
    {
        $backgroundImages = BackgroundImage::with('creator')
            ->latest()
            ->paginate(10);
            
        return view('admin.backgroundimages.index', compact('backgroundImages'));
    }

    // Show categories page
    public function categories()
    {
        // You can implement category-wise filtering here
        return view('admin.backgroundimages.categories');
    }

    // Show create form
    public function create()
    {
        $categories = Category::where('is_active', true)
            ->orderBy('order')
            ->get(['id', 'name']);
            
        return view('admin.backgroundimages.create', compact('categories'));
    }

    // Store new background image
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // 5MB max
            'assigned_categories' => 'nullable|array',
            'assigned_categories.*' => 'exists:categories,id',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('background-images', 'public');
        }

        BackgroundImage::create([
            'name' => $request->name,
            'image' => $imagePath,
            'assigned_categories' => $request->assigned_categories,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('admin.CrossChairbg.index')
            ->with('success', 'Background image added successfully!');
    }

    // Show single background image
    public function show($id)
    {
        $backgroundImage = BackgroundImage::with('creator')->findOrFail($id);
        $categories = $backgroundImage->categories();
        
        return view('admin.backgroundimages.show', compact('backgroundImage', 'categories'));
    }

    // Get background image data for editing (AJAX)
    public function edit($id)
    {
        $backgroundImage = BackgroundImage::findOrFail($id);
        return response()->json($backgroundImage);
    }

    // Update background image
    public function update(Request $request, $id)
    {
        $backgroundImage = BackgroundImage::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'assigned_categories' => 'nullable|array',
            'assigned_categories.*' => 'exists:categories,id',
        ]);

        $data = [
            'name' => $request->name,
            'assigned_categories' => $request->assigned_categories,
        ];

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($backgroundImage->image) {
                Storage::disk('public')->delete($backgroundImage->image);
            }
            $data['image'] = $request->file('image')->store('background-images', 'public');
        }

        $backgroundImage->update($data);

        return redirect()->route('admin.CrossChairbg.index')
            ->with('success', 'Background image updated successfully!');
    }

    // Delete background image
    public function destroy($id)
    {
        $backgroundImage = BackgroundImage::findOrFail($id);

        // Delete image file
        if ($backgroundImage->image) {
            Storage::disk('public')->delete($backgroundImage->image);
        }

        $backgroundImage->delete();

        return redirect()->route('admin.CrossChairbg.index')
            ->with('success', 'Background image deleted successfully!');
    }

    // Copy background image
    public function copy($id)
    {
        $original = BackgroundImage::findOrFail($id);

        // Create a copy
        $copy = $original->replicate();
        $copy->name = $original->name . ' (Copy)';
        $copy->created_by = Auth::id();
        
        // Copy the image file
        if ($original->image) {
            $extension = pathinfo($original->image, PATHINFO_EXTENSION);
            $newImagePath = 'background-images/' . uniqid() . '.' . $extension;
            Storage::disk('public')->copy($original->image, $newImagePath);
            $copy->image = $newImagePath;
        }
        
        $copy->save();

        return redirect()->route('admin.CrossChairbg.index')
            ->with('success', 'Background image copied successfully!');
    }
}