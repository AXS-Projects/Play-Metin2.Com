<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class LanguageMiddleware
{
    public function handle(Request $request, Closure $next)
    {
       //Log::info('Middleware Before setLocale', [
       //    'Session Locale' => Session::get('locale'),
       //    'App Locale' => App::getLocale(),
       //]);
	   
        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        }
    
       //Log::info('Middleware After setLocale', [
       //    'Session Locale' => Session::get('locale'),
       //    'App Locale' => App::getLocale(),
       //]);
    
        return $next($request);
    }
    
}
