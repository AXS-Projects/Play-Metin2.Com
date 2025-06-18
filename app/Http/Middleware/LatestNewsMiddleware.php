<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\News;

class LatestNewsMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $latestNewsSidebar = News::latest()->take(3)->get();
        View::share('latestNewsSidebar', $latestNewsSidebar);
        return $next($request);
    }
}
