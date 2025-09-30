<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsBranch
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('branch')->check()) {
            return $next($request);
        }
        return redirect('/branch')->with('error', 'Unauthorized access.');
    }
}