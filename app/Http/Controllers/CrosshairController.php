<?php

namespace App\Http\Controllers;

use App\Models\CrossChair;
use App\Models\Category;
use App\Models\BackgroundImage;
use Illuminate\Http\Request;

class CrosshairController extends Controller
{
    /**
     * Display a listing of crosshairs.
     */
public function index(Request $request)
    {
        $query = CrossChair::with('category')->where('is_active', true);
        
        if ($search = $request->get('search')) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        
        if ($category = $request->get('category')) {
            if ($category !== 'all') {
                $query->whereHas('category', function($q) use ($category) {
                    $q->where('slug', $category);
                });
            }
        }
        
        $sort = $request->get('sort', 'popular');
        switch ($sort) {
            case 'newest':
                $query->latest();
                break;
            case 'downloads':
                $query->orderBy('copies', 'desc');
                break;
            case 'rating':
                $query->orderBy('views', 'desc');
                break;
            default:
                $query->orderByRaw('(views * 2 + copies * 3) DESC');
                break;
        }
        
        $crosshairs = $query->paginate(100)->withQueryString();
        
        if ($request->ajax() || $request->wantsJson()) {
            $html = '';
            foreach ($crosshairs as $crosshair) {
                $imageUrl = $crosshair->image 
                    ? url('storage/app/public/' . $crosshair->image) 
                    : null;
                
                $html .= view('user.crosshairs.partials.crosshair-card', compact('crosshair', 'imageUrl'))->render();
            }
            
            return response()->json([
                'html' => $html,
                'hasMorePages' => $crosshairs->hasMorePages(),
                'currentPage' => $crosshairs->currentPage(),
                'lastPage' => $crosshairs->lastPage()
            ]);
        }
        
        $categories = Category::where('is_active', true)
            ->ordered()
            ->get()
            ->pluck('name', 'slug')
            ->prepend('All Categories', 'all');
        
        return view('user.crosshairs.index', compact('crosshairs', 'categories'));
    }
    /**
     * Display the specified crosshair.
     */
    public function show($identifier)
    {
        // Check if identifier is numeric (ID) or string (slug)
        if (is_numeric($identifier)) {
            $crosshair = CrossChair::with('category')
                ->where('id', $identifier)
                ->where('is_active', true)
                ->firstOrFail();
        } else {
            $crosshair = CrossChair::with('category')
                ->where('slug', $identifier)
                ->where('is_active', true)
                ->firstOrFail();
        }
        
        // Increment views
        $crosshair->incrementViews();
        
        // Get background images for this crosshair's category
        $backgroundImages = [];
        if ($crosshair->category_id) {
            $backgroundImages = BackgroundImage::whereJsonContains('assigned_categories', $crosshair->category_id)
                ->orWhere(function($query) use ($crosshair) {
                    $query->whereRaw("JSON_CONTAINS(assigned_categories, '\"" . $crosshair->category_id . "\"')");
                })
                ->get();
        }
        
        // If no category-specific backgrounds, get all backgrounds
        if ($backgroundImages->isEmpty()) {
            $backgroundImages = BackgroundImage::take(5)->get();
        }
        
        // Get related crosshairs (same category)
        $relatedCrosshairs = CrossChair::with('category')
            ->where('category_id', $crosshair->category_id)
            ->where('id', '!=', $crosshair->id)
            ->where('is_active', true)
            ->inRandomOrder()
            ->take(4)
            ->get();
        
        return view('user.crosshairs.show', compact('crosshair', 'relatedCrosshairs', 'backgroundImages'));
    }
    
    /**
     * Show crosshair categories.
     */
    public function categories()
    {
        $categories = Category::with(['crossChairs' => function($query) {
            $query->where('is_active', true);
        }])
        ->where('is_active', true)
        ->ordered()
        ->get()
        ->map(function($category) {
            return [
                'name' => $category->name,
                'slug' => $category->slug,
                'description' => $category->description ?? 'Explore crosshairs in this category',
                'count' => $category->crossChairs->count(),
                'image' => $category->image ? asset('storage/' . $category->image) : null,
            ];
        });
        
        return view('user.crosshairs.categories', compact('categories'));
    }
    
    /**
     * Copy crosshair code (increment copies counter).
     */
    public function copy($id)
    {
        $crosshair = CrossChair::findOrFail($id);
        $crosshair->incrementCopies();
        
        return response()->json([
            'success' => true,
            'code' => $crosshair->crosshair_code,
            'copies' => $crosshair->copies
        ]);
    }
}