<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class WelcomeController extends Controller
{
    public function index()
    {
        $latestNews = News::latest()->take(3)->get();
        return view('welcome', compact('latestNews'));
    }
}

