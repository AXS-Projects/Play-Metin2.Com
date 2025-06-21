<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\News;
use App\Models\GalleryItem;

class WelcomeController extends Controller
{
    public function index()
    {
        $latestNews = Cache::remember('latest_news', 60, function () {
            return News::withCount('comments')->latest()->take(3)->get();
        });
        $latestMedia = Cache::remember('latest_media', 60, function () {
            return GalleryItem::latest()->take(4)->get();
        });
        return view('welcome', compact('latestNews', 'latestMedia'));
    }
}

