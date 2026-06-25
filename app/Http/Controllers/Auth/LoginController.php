<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Redirect user based on their role after login
     */
    protected function authenticated(Request $request, $user)
    {
        // Check if user is admin
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        
        // Check if user is regular user
        if ($user->isUser()) {
            return redirect()->route('user.dashboard');
        }
        
        // Default fallback
        return redirect()->route('home');
    }
}