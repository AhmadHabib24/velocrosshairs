<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CrossChair;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CrossChairController extends Controller
{
    public function index()
    {
        $activeCrosschairs = CrossChair::with('category')
            ->where('is_active', true)
            ->orderBy('order', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(15, ['*'], 'active_page');
        
        $inactiveCrosschairs = CrossChair::with('category')
            ->where('is_active', false)
            ->orderBy('order', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(15, ['*'], 'inactive_page');
        
        $categories = Category::active()->ordered()->get();
        
        return view('admin.crosschair.index', compact('activeCrosschairs', 'inactiveCrosschairs', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:cross_chairs,slug',
            'crosshair_code' => 'required|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'order' => 'nullable|integer',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'is_active' => 'nullable|boolean'
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        if (CrossChair::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $validated['slug'] . '-' . time();
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . Str::slug($validated['name']) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('crosschairs', $imageName, 'public');
            $validated['image'] = $imagePath;
        }

        if (empty($validated['meta_title'])) {
            $validated['meta_title'] = $validated['name'] . ' - Valorant Crosshair';
        }

        if (empty($validated['meta_description'])) {
            $validated['meta_description'] = 'Download and use ' . $validated['name'] . ' crosshair code for Valorant. Professional gaming crosshair settings.';
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        CrossChair::create($validated);

        return redirect()->route('admin.CrossChair.index')
            ->with('success', 'CrossChair created successfully!');
    }

    public function edit($id)
    {
        $crosschair = CrossChair::with('category')->findOrFail($id);
        return response()->json($crosschair);
    }

    public function update(Request $request, $id)
    {
        $crosschair = CrossChair::findOrFail($id);

        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:cross_chairs,slug,' . $id,
            'crosshair_code' => 'required|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'order' => 'nullable|integer',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'is_active' => 'nullable|boolean'
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        if ($request->hasFile('image')) {
            if ($crosschair->image && \Storage::disk('public')->exists($crosschair->image)) {
                \Storage::disk('public')->delete($crosschair->image);
            }

            $image = $request->file('image');
            $imageName = time() . '_' . Str::slug($validated['name']) . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('crosschairs', $imageName, 'public');
            $validated['image'] = $imagePath;
        }

        if (empty($validated['meta_title'])) {
            $validated['meta_title'] = $validated['name'] . ' - Valorant Crosshair';
        }

        if (empty($validated['meta_description'])) {
            $validated['meta_description'] = 'Download and use ' . $validated['name'] . ' crosshair code for Valorant. Professional gaming crosshair settings.';
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['order'] = $validated['order'] ?? 0;

        $crosschair->update($validated);

        return redirect()->route('admin.CrossChair.index')
            ->with('success', 'CrossChair updated successfully!');
    }

    public function destroy($id)
    {
        $crosschair = CrossChair::findOrFail($id);

        if ($crosschair->image && \Storage::disk('public')->exists($crosschair->image)) {
            \Storage::disk('public')->delete($crosschair->image);
        }

        $crosschair->delete();

        return redirect()->route('admin.CrossChair.index')
            ->with('success', 'CrossChair deleted successfully!');
    }

    public function toggleStatus($id)
    {
        $crosschair = CrossChair::findOrFail($id);
        $crosschair->is_active = !$crosschair->is_active;
        $crosschair->save();

        return response()->json([
            'success' => true,
            'is_active' => $crosschair->is_active
        ]);
    }
}