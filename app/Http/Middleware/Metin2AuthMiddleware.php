<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Metin2AuthMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('metin2')->check()) {
            return redirect()->route('index')->with('error', 'Trebuie să fii autentificat pentru a accesa această pagină.');
        }

        return $next($request);
    }
}
