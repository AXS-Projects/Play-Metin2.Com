<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\GalleryItem;

class WelcomeController extends Controller
{
    public function index()
    {
        $latestNews = News::latest()->take(3)->get();
        $latestMedia = GalleryItem::latest()->take(4)->get();
        return view('welcome', compact('latestNews', 'latestMedia'));
    }
}

