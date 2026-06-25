<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Category;
use App\Models\CrossChair;
use App\Models\Contact;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Gather all statistics
        $stats = [
            // User Statistics
            'total_users' => User::count(),
            'active_users' => User::where('is_active', true)->count(),
            'admin_users' => User::where('role', 'admin')->count(),
            'inactive_users' => User::where('is_active', false)->count(),
            
            // Category Statistics
            'total_categories' => Category::count(),
            'active_categories' => Category::where('is_active', true)->count(),
            'inactive_categories' => Category::where('is_active', false)->count(),
            
            // CrossChair Statistics
            'total_crosschairs' => CrossChair::count(),
            'active_crosschairs' => CrossChair::where('is_active', true)->count(),
            'inactive_crosschairs' => CrossChair::where('is_active', false)->count(),
            
            // Analytics
            'total_views' => CrossChair::sum('views'),
            'total_copies' => CrossChair::sum('copies'),
        ];
        
        // Recent Users (last 5)
        $recent_users = User::latest()
            ->take(5)
            ->get();
        
        // Recent CrossChairs (last 5)
        $recent_crosschairs = CrossChair::with('category')
            ->latest()
            ->take(5)
            ->get();
        
        // Most Popular CrossChairs (by views)
        $popular_crosschairs = CrossChair::where('is_active', true)
            ->orderBy('views', 'desc')
            ->take(5)
            ->get();
        
        // Top SEO Ranking CrossChairs (by combined views + copies + SEO score)
        $top_seo_crosschairs = CrossChair::where('is_active', true)
            ->with('category')
            ->selectRaw('*, (views * 2 + copies * 3) as seo_score')
            ->orderBy('seo_score', 'desc')
            ->take(10)
            ->get();
        
        return view('admin.dashboard', compact(
            'stats',
            'recent_users',
            'recent_crosschairs',
            'popular_crosschairs',
            'top_seo_crosschairs'
        ));
    }
    
    public function contactindex()
    {
        // Fetch all contacts with pagination
        $contacts = Contact::latest()->paginate(15);
        
        // Contact statistics
        $contactStats = [
            'total_contacts' => Contact::count(),
            'pending_contacts' => Contact::where('status', 'pending')->count(),
            'read_contacts' => Contact::where('status', 'read')->count(),
            'replied_contacts' => Contact::where('status', 'replied')->count(),
            'archived_contacts' => Contact::where('status', 'archived')->count(),
        ];
        
        return view('admin.contact-us.index', compact('contacts', 'contactStats'));
    }
    
    /**
     * Mark contact as read
     */
    public function markAsRead($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->markAsRead();
        
        return redirect()->back()->with('success', 'Contact marked as read successfully!');
    }
    
    /**
     * Mark contact as replied
     */
    public function markAsReplied($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->markAsReplied();
        
        return redirect()->back()->with('success', 'Contact marked as replied successfully!');
    }
    
    /**
     * Archive contact
     */
    public function archiveContact($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->archive();
        
        return redirect()->back()->with('success', 'Contact archived successfully!');
    }
    
    /**
     * Delete contact
     */
    public function deleteContact($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        
        return redirect()->back()->with('success', 'Contact deleted successfully!');
    }
    public function getContactDetails($id)
{
    $contact = Contact::findOrFail($id);
    return response()->json($contact);
}
}