<?php

namespace App\Http\Controllers;

use App\Models\GalleryItem;
use App\Models\GalleryComment;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $photos = GalleryItem::whereNotNull('image_path')->latest()->get();
        $videos = GalleryItem::whereNotNull('video_url')->latest()->get();
        return view('gallery.index', compact('photos', 'videos'));
    }

    public function show(GalleryItem $item)
    {
        $comments = $item->comments()->latest()->get();
        return view('gallery.show', compact('item', 'comments'));
    }

    public function comment(Request $request, GalleryItem $item)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $item->comments()->create([
            'author' => $request->input('author'),
            'content' => $request->input('content'),
        ]);

        return redirect()->back();
    }

    public function like(GalleryComment $comment)
    {
        $comment->increment('likes');
        return redirect()->back();
    }

    public function dislike(GalleryComment $comment)
    {
        $comment->increment('dislikes');
        return redirect()->back();
    }
}
