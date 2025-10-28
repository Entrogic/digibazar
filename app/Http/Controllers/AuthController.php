<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Show the login form
     */
    public function showLoginForm()
    {
        // Redirect if already authenticated
        if (Auth::check() && Auth::user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        return view('auth.login');
    }

    /**
     * Handle login request
     */
    public function login(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ], [
            'email.required' => 'ইমেইল ঠিকানা প্রয়োজন।',
            'email.email' => 'বৈধ ইমেইল ঠিকানা দিন।',
            'password.required' => 'পাসওয়ার্ড প্রয়োজন।',
            'password.min' => 'পাসওয়ার্ড কমপক্ষে ৬ অক্ষরের হতে হবে।',
        ]);

        // Find user by email
        $user = User::where('email', $request->email)->first();

        // Check if user exists and password is correct
        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => 'এই ইমেইল এবং পাসওয়ার্ড সঠিক নয়।',
            ]);
        }

        // Check if user is admin
        if (!$user->isAdmin()) {
            throw ValidationException::withMessages([
                'email' => 'আপনি অ্যাডমিন নন। অ্যাক্সেস নেই।',
            ]);
        }

        // Login the user
        Auth::login($user, $request->filled('remember'));

        // Regenerate session for security
        $request->session()->regenerate();

        // Redirect to admin dashboard
        return redirect()->intended(route('admin.dashboard'))->with('success', 'সফলভাবে লগইন হয়েছে!');
    }

    /**
     * Show admin dashboard
     */
    public function dashboard()
    {
        // Check if user is authenticated and is admin
        if (!Auth::check() || !Auth::user()->isAdmin()) {
            return redirect()->route('login')->with('error', 'অ্যাক্সেস নেই।');
        }

        $user = Auth::user();
        $totalUsers = User::count();
        $totalAdmins = User::admins()->count();

        return view('admin.dashboard', compact('user', 'totalUsers', 'totalAdmins'));
    }

    /**
     * Handle logout request
     */
    public function logout(Request $request)
    {
        // Logout the user
        Auth::logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate the session token
        $request->session()->regenerateToken();

        // Redirect to login with success message
        return redirect()->route('login')->with('success', 'সফলভাবে লগআউট হয়েছে!');
    }

    /**
     * Check if current user is admin (helper method)
     */
    public function isAdmin()
    {
        return Auth::check() && Auth::user()->isAdmin();
    }
}
