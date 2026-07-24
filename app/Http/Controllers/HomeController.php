<?php

namespace App\Http\Controllers;

use App\Models\CrossChair;
use App\Models\Category;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

class HomeController extends Controller
{
    /**
     * Show the application dashboard with dynamic data.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Fetch real statistics from database
        $stats = [
            'total_users' => User::count(),
            'total_downloads' => CrossChair::sum('copies'),
            'total_crosshairs' => CrossChair::where('is_active', true)->count(),
            'uptime' => 99.9 // This can be from a monitoring service
        ];
        
        // Get most popular crosshairs (by combined views and copies)
        $popularCrosshairs = CrossChair::with('category')
            ->where('is_active', true)
            ->select('*')
            ->selectRaw('(views * 2 + copies * 3) as popularity_score')
            ->orderBy('popularity_score', 'desc')
            ->take(6)
            ->get();
        
        // Get most recent crosshairs
        $recentCrosshairs = CrossChair::with('category')
            ->where('is_active', true)
            ->latest()
            ->take(6)
            ->get();
        
        // Get featured categories (categories with most crosshairs)
        $featuredCategories = Category::with(['crossChairs' => function($query) {
                $query->where('is_active', true);
            }])
            ->where('is_active', true)
            ->withCount(['crossChairs' => function($query) {
                $query->where('is_active', true);
            }])
            ->orderBy('cross_chairs_count', 'desc')
            ->take(6)
            ->get();
        
        // Get top downloaded crosshairs this week
        $topThisWeek = CrossChair::with('category')
            ->where('is_active', true)
            ->where('created_at', '>=', now()->subWeek())
            ->orderBy('copies', 'desc')
            ->take(3)
            ->get();
        
        return view('user.home.index', compact(
            'stats',
            'popularCrosshairs',
            'recentCrosshairs',
            'featuredCategories',
            'topThisWeek'
        ));
    }
    
    
    public function about()
    {
        return view('user.about.index');
    }
        public function contact()
    {
        $num1 = rand(1, 10);
        $num2 = rand(1, 10);
        session(['captcha_answer' => $num1 + $num2]);
        
        return view('user.contact.index', compact('num1', 'num2'));
    }
    
    public function submitContact(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|in:general,crosshair_submission,crosshair_correction,technical_support,business_partnership,feedback,other',
            'crosshair_code' => 'nullable|string|max:500',
            'message' => 'required|string|min:10|max:2000',
            'captcha' => 'required|integer',
        ], [
            'name.required' => 'Please enter your name.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',
            'subject.required' => 'Please select a subject.',
            'subject.in' => 'Please select a valid subject.',
            'message.required' => 'Please enter your message.',
            'message.min' => 'Message must be at least 10 characters.',
            'message.max' => 'Message cannot exceed 2000 characters.',
            'crosshair_code.max' => 'Crosshair code is too long.',
            'captcha.required' => 'Please solve the math problem to verify you are human.',
            'captcha.integer' => 'Captcha answer must be a number.',
        ]);
        
        $validator->after(function ($validator) use ($request) {
            if ($request->has('captcha') && (int)$request->captcha !== session('captcha_answer')) {
                $validator->errors()->add('captcha', 'Incorrect captcha answer, please try again.');
            }
        });
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
    
        try {
            // Create contact record
            $contact = Contact::create([
                'name' => $request->name,
                'email' => $request->email,
                'subject' => $request->subject,
                'crosshair_code' => $request->crosshair_code,
                'message' => $request->message,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);
    
            // Send email notification to admin
            Mail::to(env('ADMIN_EMAIL'))->send(new ContactFormMail($contact->toArray()));
    
            return redirect()->back()
                ->with('success', 'Thank you for contacting us! We\'ll get back to you soon.');
                
        } catch (\Exception $e) {
            \Log::error('Contact form error: ' . $e->getMessage());
            
            return redirect()->back()
                ->with('error', 'Something went wrong. Please try again.')
                ->withInput();
        }
    }
    
    public function PrivacyPolicy()
    {
        return view('user.PrivacyPolicy.index');
    }
    
    
}