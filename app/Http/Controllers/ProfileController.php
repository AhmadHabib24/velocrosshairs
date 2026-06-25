<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the user profile.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        
        // Use real stats where possible, default to 0 otherwise
        $userStats = [
            'join_date' => $user->created_at,
            'total_uploads' => $user->crossChairs()->count() ?? 0,
            'total_downloads' => $user->crossChairs()->sum('copies') ?? 0,
            'total_likes' => 0, // Update if likes relation is added
            'featured_count' => 0,
        ];
        
        // Fetch recent crosshairs created by user
        $recentCrosshairs = $user->crossChairs()->latest()->take(5)->get()->map(function($c) {
            return [
                'name' => $c->name,
                'downloads' => $c->copies,
                'rating' => 5,
                'status' => $c->status,
            ];
        })->toArray();
        
        $achievements = [
            // Mocked achievements
            [
                'name' => 'First Upload',
                'description' => 'Uploaded your first crosshair',
                'unlocked' => $userStats['total_uploads'] > 0,
                'icon' => 'fas fa-upload',
                'date' => $userStats['total_uploads'] > 0 ? now() : null,
            ]
        ];

        return view('user.profile.index', compact('user', 'userStats', 'recentCrosshairs', 'achievements'));
    }

    /**
     * Show the user downloads.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function downloads()
    {
        $user = Auth::user();
        
        // Fetch user downloads. Mocked for now.
        $downloads = [];
        
        return view('user.profile.downloads', compact('user', 'downloads'));
    }
}
