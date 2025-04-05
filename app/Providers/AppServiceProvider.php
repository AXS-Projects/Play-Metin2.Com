<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
	public function boot(): void
	{
		// ✅ Aplică limba din sesiune dacă există
		if (Session::has('locale')) {
			App::setLocale(Session::get('locale'));

			Log::info('AppServiceProvider Applied Language:', [
				'Session Locale' => Session::get('locale'),
				'App Locale' => App::getLocale(),
			]);
		}
	}
}
