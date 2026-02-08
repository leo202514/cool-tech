<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorAuth
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && (Auth::user()->role === 'writer' || Auth::user()->role === 'admin')) {
            return $next($request);
        }

        return redirect('/login')->with('error', 'Writer access only.');
    }
}
