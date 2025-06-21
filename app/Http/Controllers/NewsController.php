<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Comment;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::with('category')->withCount('comments')->latest()->paginate(10);
        return view('news.index', compact('news'));
    }

    public function show($slug)
    {
        $news = News::with('category')->where('slug', $slug)->firstOrFail();
        $news->increment('views');
        $comments = $news->comments()
            ->whereNull('parent_id')
            ->with('replies')
            ->latest()
            ->get();
        return view('news.show', compact('news', 'comments'));
    }

    public function comment(Request $request, $slug)
    {
        if (!Auth::guard('metin2')->check()) {
            return redirect()->back()->with('error', __('messages.error_not_authenticated'));
        }

        $request->validate([
            'content' => 'required|string',
        ]);

        $news = News::where('slug', $slug)->firstOrFail();

        $news->comments()->create([
            'author' => Auth::guard('metin2')->user()->login,
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

    public function likeNews(News $news)
    {
        $news->increment('likes');
        return redirect()->back();
    }

    public function dislikeNews(News $news)
    {
        $news->increment('dislikes');
        return redirect()->back();
    }

    public function reply(Request $request, Comment $comment)
    {
        if (!Auth::guard('metin2')->check()) {
            return redirect()->back()->with('error', __('messages.error_not_authenticated'));
        }

        $request->validate([
            'content' => 'required|string',
        ]);

        $comment->replies()->create([
            'news_id' => $comment->news_id,
            'author' => Auth::guard('metin2')->user()->login,
            'content' => $request->input('content'),
        ]);

        return redirect()->back();
    }

    public function category($slug)
    {
        $category = NewsCategory::where('slug', $slug)->firstOrFail();
        $news = News::with('category')
            ->where('news_category_id', $category->id)
            ->withCount('comments')
            ->latest()
            ->paginate(10);
        $heading = 'Category: ' . $category->name;
        $pageTitle = $category->name . ' News';
        return view('news.index', compact('news', 'heading', 'pageTitle'));
    }

    public function author($author)
    {
        $news = News::with('category')
            ->where('author', $author)
            ->withCount('comments')
            ->latest()
            ->paginate(10);
        $heading = 'News posted by ' . $author;
        $pageTitle = 'Posts by ' . $author;
        return view('news.index', compact('news', 'heading', 'pageTitle'));
    }
}
