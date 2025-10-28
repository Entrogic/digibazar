<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'আপনাকে প্রথমে লগইন করতে হবে।');
        }

        // Check if authenticated user is admin
        if (!Auth::user()->isAdmin()) {
            Auth::logout();
            return redirect()->route('login')->with('error', 'আপনি অ্যাডমিন নন। অ্যাক্সেস নেই।');
        }

        return $next($request);
    }
}
