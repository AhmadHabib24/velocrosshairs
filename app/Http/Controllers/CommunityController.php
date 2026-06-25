<?php

// CommunityController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommunityController extends Controller
{
    public function index()
    {
        $featuredCrosshairs = $this->getFeaturedCrosshairs();
        $topContributors = $this->getTopContributors();
        $recentActivity = $this->getRecentActivity();
        
        return view('user.community.index', compact('featuredCrosshairs', 'topContributors', 'recentActivity'));
    }
    
    public function leaderboard()
    {
        $leaderboard = $this->getLeaderboard();
        $categories = ['downloads', 'uploads', 'ratings', 'featured'];
        
        return view('user.community.leaderboard', compact('leaderboard', 'categories'));
    }
    
    private function getFeaturedCrosshairs()
    {
        return [
            [
                'id' => 1,
                'name' => 'Pro Tournament',
                'author' => 'ProGamer123',
                'downloads' => 5247,
                'rating' => 4.9,
                'featured_date' => '2024-01-22',
                'preview' => 'pro-crosshair'
            ],
            [
                'id' => 2,
                'name' => 'Minimal Elite',
                'author' => 'MinimalMaster',
                'downloads' => 3834,
                'rating' => 4.8,
                'featured_date' => '2024-01-20',
                'preview' => 'minimal-crosshair'
            ]
        ];
    }
    
    private function getTopContributors()
    {
        return [
            [
                'username' => 'ProGamer123',
                'uploads' => 45,
                'downloads' => 125000,
                'avatar' => 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?w=100',
                'rank' => 1
            ],
            [
                'username' => 'CrosshairKing',
                'uploads' => 38,
                'downloads' => 98000,
                'avatar' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=100',
                'rank' => 2
            ],
            [
                'username' => 'AimMaster',
                'uploads' => 32,
                'downloads' => 87000,
                'avatar' => 'https://images.unsplash.com/photo-1599566150163-29194dcaad36?w=100',
                'rank' => 3
            ]
        ];
    }
    
    private function getRecentActivity()
    {
        return [
            [
                'type' => 'upload',
                'user' => 'NewPlayer',
                'action' => 'uploaded',
                'item' => 'Neon Glow',
                'time' => '2 hours ago'
            ],
            [
                'type' => 'featured',
                'user' => 'ProGamer123',
                'action' => 'got featured',
                'item' => 'Tournament Pro',
                'time' => '4 hours ago'
            ]
        ];
    }
    
    private function getLeaderboard()
    {
        return [
            [
                'username' => 'ProGamer123',
                'downloads' => 125000,
                'uploads' => 45,
                'average_rating' => 4.8,
                'featured_count' => 12,
                'rank' => 1,
                'avatar' => 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?w=100'
            ],
            [
                'username' => 'CrosshairKing',
                'downloads' => 98000,
                'uploads' => 38,
                'average_rating' => 4.7,
                'featured_count' => 8,
                'rank' => 2,
                'avatar' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=100'
            ]
        ];
    }
}

// ProfileController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $userStats = $this->getUserStats($user->id);
        $recentCrosshairs = $this->getUserCrosshairs($user->id);
        $achievements = $this->getUserAchievements($user->id);
        
        return view('user.profile.index', compact('user', 'userStats', 'recentCrosshairs', 'achievements'));
    }
    
    public function downloads()
    {
        $user = Auth::user();
        $downloads = $this->getUserDownloads($user->id);
        
        return view('user.profile.downloads', compact('user', 'downloads'));
    }
    
    private function getUserStats($userId)
    {
        return [
            'total_uploads' => 12,
            'total_downloads' => 4567,
            'total_likes' => 892,
            'featured_count' => 3,
            'join_date' => '2023-06-15',
            'last_activity' => '2024-01-22'
        ];
    }
    
    private function getUserCrosshairs($userId)
    {
        return [
            [
                'id' => 1,
                'name' => 'My Custom Cross',
                'downloads' => 1234,
                'rating' => 4.5,
                'created_at' => '2024-01-15',
                'status' => 'published'
            ]
        ];
    }
    
    private function getUserAchievements($userId)
    {
        return [
            [
                'name' => 'First Upload',
                'description' => 'Upload your first crosshair',
                'icon' => 'fas fa-upload',
                'unlocked' => true,
                'date' => '2023-06-16'
            ],
            [
                'name' => '1K Downloads',
                'description' => 'Reach 1,000 total downloads',
                'icon' => 'fas fa-download',
                'unlocked' => true,
                'date' => '2023-08-22'
            ],
            [
                'name' => 'Community Favorite',
                'description' => 'Get a crosshair featured',
                'icon' => 'fas fa-star',
                'unlocked' => false,
                'date' => null
            ]
        ];
    }
    
    private function getUserDownloads($userId)
    {
        return [
            [
                'crosshair_id' => 1,
                'name' => 'Pro Classic',
                'author' => 'ProGamer123',
                'downloaded_at' => '2024-01-20 14:30:00',
                'preview' => 'classic-crosshair'
            ],
            [
                'crosshair_id' => 2,
                'name' => 'Minimal+',
                'author' => 'CleanDesign',
                'downloaded_at' => '2024-01-18 09:15:00',
                'preview' => 'minimal-crosshair'
            ]
        ];
    }
}