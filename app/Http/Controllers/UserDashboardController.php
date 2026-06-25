<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\CrossChair;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\CrosshairSubmittedMail;
use App\Models\Notification;

class UserDashboardController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the user dashboard.
     */
    public function index()
    {
        try {
            $user = Auth::user();
            
            // Check if user exists
            if (!$user) {
                return redirect()->route('login')->with('error', 'Please login to continue');
            }

            // Get user's crosshairs statistics
            $userCrosshairs = CrossChair::where('created_by', $user->id);
            
            $stats = [
                'total_crosshairs' => $userCrosshairs->count(),
                'approved' => (clone $userCrosshairs)->where('status', 'approved')->count(),
                'pending' => (clone $userCrosshairs)->where('status', 'pending')->count(),
                'rejected' => (clone $userCrosshairs)->where('status', 'rejected')->count(),
                'total_views' => (clone $userCrosshairs)->sum('views'),
                'total_copies' => (clone $userCrosshairs)->sum('copies'),
            ];

            // Get user's crosshairs grouped by status
            $my_crosshairs = [
                'approved' => CrossChair::where('created_by', $user->id)
                    ->where('status', 'approved')
                    ->with('category')
                    ->latest()
                    ->take(5)
                    ->get() ?? collect(),
                
                'pending' => CrossChair::where('created_by', $user->id)
                    ->where('status', 'pending')
                    ->with('category')
                    ->latest()
                    ->take(5)
                    ->get() ?? collect(),
                
                'rejected' => CrossChair::where('created_by', $user->id)
                    ->where('status', 'rejected')
                    ->with('category')
                    ->latest()
                    ->take(5)
                    ->get() ?? collect(),
            ];

            // Get user's favorite crosshairs (placeholder for future implementation)
            $favorites = collect();

            // Get user's recently viewed crosshairs (placeholder for future implementation)
            $recent_views = collect();

            // Get popular approved crosshairs (excluding user's own)
            $popular_crosshairs = CrossChair::where('status', 'approved')
                ->where('is_active', true)
                ->where('created_by', '!=', $user->id)
                ->with(['category', 'creator'])
                ->orderBy('views', 'desc')
                ->take(6)
                ->get() ?? collect();

            // Get trending crosshairs (by copies)
            $trending_crosshairs = CrossChair::where('status', 'approved')
                ->where('is_active', true)
                ->with(['category', 'creator'])
                ->orderBy('copies', 'desc')
                ->take(6)
                ->get() ?? collect();

            // Get active categories with approved crosshairs count (needed for the modal)
            $categories = Category::where('is_active', true)
                ->withCount(['crossChairs' => function ($query) {
                    $query->where('status', 'approved')
                          ->where('is_active', true);
                }])
                ->orderBy('order')
                ->get() ?? collect();

            // Get recent approved crosshairs
            $recent_approved = CrossChair::where('status', 'approved')
                ->where('is_active', true)
                ->with(['category', 'creator'])
                ->latest()
                ->take(6)
                ->get() ?? collect();

            return view('user.user_dash.index', compact(
                'stats',
                'my_crosshairs',
                'favorites',
                'recent_views',
                'popular_crosshairs',
                'trending_crosshairs',
                'categories',
                'recent_approved'
            ));

        } catch (\Exception $e) {
            // Log the error
            \Log::error('User Dashboard Error: ' . $e->getMessage());
            
            // Return with empty data and error message
            return view('user.user_dash.index', [
                'stats' => [
                    'total_crosshairs' => 0,
                    'approved' => 0,
                    'pending' => 0,
                    'rejected' => 0,
                    'total_views' => 0,
                    'total_copies' => 0,
                ],
                'my_crosshairs' => [
                    'approved' => collect(),
                    'pending' => collect(),
                    'rejected' => collect(),
                ],
                'favorites' => collect(),
                'recent_views' => collect(),
                'popular_crosshairs' => collect(),
                'trending_crosshairs' => collect(),
                'categories' => collect(),
                'recent_approved' => collect(),
            ])->with('error', 'An error occurred while loading your dashboard. Please try again.');
        }
    }

    /**
     * Store a newly created crosshair (User Submission)
     */
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'crosshair_code' => 'required|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'terms_accepted' => 'required|accepted'
        ]);

        try {
            $user = Auth::user();

            // Generate slug from name
            $slug = Str::slug($validated['name']);
            
            // Ensure slug is unique
            $originalSlug = $slug;
            $counter = 1;
            while (CrossChair::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }

            // Handle image upload
            $imagePath = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('crosshairs', $imageName, 'public');
            }

            // Auto-generate SEO fields
            $metaTitle = $validated['name'] . ' - Valorant Crosshair | CrosshairDB';
            $metaDescription = 'Try the ' . $validated['name'] . ' crosshair for Valorant. ' . 
                              ($validated['description'] ? Str::limit($validated['description'], 120) : 
                              'Professional crosshair settings for better aim and precision.');
            
            // Extract category name for keywords
            $category = Category::find($validated['category_id']);
            $metaKeywords = 'valorant, crosshair, ' . strtolower($validated['name']) . ', ' . 
                           ($category ? strtolower($category->name) : 'gaming') . ', fps, settings';

            // Create the crosshair with pending status
            $crosshair = CrossChair::create([
                'category_id' => $validated['category_id'],
                'created_by' => $user->id,
                'name' => $validated['name'],
                'slug' => $slug,
                'crosshair_code' => $validated['crosshair_code'],
                'description' => $validated['description'],
                'image' => $imagePath,
                'status' => 'pending', // Set status to pending for review
                'is_active' => false, // Not active until approved
                'order' => 0,
                'views' => 0,
                'copies' => 0,
                'meta_title' => $metaTitle,
                'meta_description' => $metaDescription,
                'meta_keywords' => $metaKeywords,
            ]);

            // Send email to admin
            $adminEmail = env('ADMIN_EMAIL');
            $adminUrl = route('admin.CrossChair.index'); // Link to admin crosshairs page

            if ($adminEmail) {
                Mail::to($adminEmail)->send(new CrosshairSubmittedMail($crosshair, $user, $adminUrl));
            }

            // Create notification for admin
            Notification::createNotification(
                'new_crosshair',
                'New Crosshair Submitted',
                "User '{$user->name}' has submitted a new crosshair '{$crosshair->name}' for review.",
                [
                    'crosshair_id' => $crosshair->id,
                    'link' => $adminUrl,
                ]
            );

            return redirect()->route('user.dashboard')
                ->with('success', 'Crosshair submitted successfully! It will be reviewed by our team.');

        } catch (\Exception $e) {
            // Log the error
            \Log::error('Error creating crosshair: ' . $e->getMessage());
            
            return redirect()->back()
                ->with('error', 'Failed to submit crosshair. Please try again.')
                ->withInput();
        }
    }

    /**
     * Show user's crosshairs by status
     */
    public function myCrosshairs(Request $request)
    {
        try {
            $user = Auth::user();
            
            if (!$user) {
                return redirect()->route('login')->with('error', 'Please login to continue');
            }

            $status = $request->get('status', 'all');
            
            $query = CrossChair::where('created_by', $user->id)
                ->with(['category']);

            // Filter by status if provided
            if ($status !== 'all' && in_array($status, ['pending', 'approved', 'rejected'])) {
                $query->where('status', $status);
            }

            $crosshairs = $query->latest()->paginate(12);

            return view('user.user_dash.my-crosshairs', compact('crosshairs', 'status'));

        } catch (\Exception $e) {
            \Log::error('My Crosshairs Error: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while loading your crosshairs.');
        }
    }

    /**
     * Show user's statistics
     */
    public function statistics()
    {
        try {
            $user = Auth::user();
            
            if (!$user) {
                return redirect()->route('login')->with('error', 'Please login to continue');
            }

            // Detailed statistics
            $stats = [
                'total_crosshairs' => CrossChair::where('created_by', $user->id)->count(),
                'approved' => CrossChair::where('created_by', $user->id)->where('status', 'approved')->count(),
                'pending' => CrossChair::where('created_by', $user->id)->where('status', 'pending')->count(),
                'rejected' => CrossChair::where('created_by', $user->id)->where('status', 'rejected')->count(),
                'total_views' => CrossChair::where('created_by', $user->id)->sum('views'),
                'total_copies' => CrossChair::where('created_by', $user->id)->sum('copies'),
                'most_viewed' => CrossChair::where('created_by', $user->id)
                    ->orderBy('views', 'desc')
                    ->first(),
                'most_copied' => CrossChair::where('created_by', $user->id)
                    ->orderBy('copies', 'desc')
                    ->first(),
            ];

            // Crosshairs by category
            $by_category = CrossChair::where('created_by', $user->id)
                ->with('category')
                ->get()
                ->groupBy('category.name');

            return view('user.user_dash.statistics', compact('stats', 'by_category'));

        } catch (\Exception $e) {
            \Log::error('User Statistics Error: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while loading your statistics.');
        }
    }
}