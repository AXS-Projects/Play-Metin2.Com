<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Comment;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::latest()->paginate(10);
        return view('news.index', compact('news'));
    }

    public function show($slug)
    {
        $news = News::where('slug', $slug)->firstOrFail();
        $comments = $news->comments()->latest()->get();
        return view('news.show', compact('news', 'comments'));
    }

    public function comment(Request $request, $slug)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $news = News::where('slug', $slug)->firstOrFail();

        $news->comments()->create([
            'author' => $request->input('author'),
            'content' => $request->input('content'),
        ]);

        return redirect()->back();
    }

    public function like(Comment $comment)
    {
        $comment->increment('likes');
        return redirect()->back();
    }

    public function dislike(Comment $comment)
    {
        $comment->increment('dislikes');
        return redirect()->back();
    }
}
