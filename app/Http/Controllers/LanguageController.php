<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class LanguageController extends Controller
{
    public function switchLang($lang)
    {
        if (in_array($lang, ['en', 'ro', 'fr'])) {
            Session::put('locale', $lang);
            App::setLocale($lang);
            Log::info('Language Switched:', [
                'Requested Lang' => $lang,
                'Session Locale' => Session::get('locale'),
                'App Locale' => App::getLocale(),
            ]);
        }

        return redirect()->back();
    }
}
