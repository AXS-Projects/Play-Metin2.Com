<?php

namespace App\Http\Controllers;

use App\Models\GalleryItem;
use App\Models\GalleryComment;
use App\Models\Reaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $this->react($comment, true);
        return redirect()->back();
    }

    public function dislike(GalleryComment $comment)
    {
        $this->react($comment, false);
        return redirect()->back();
    }

    private function react(Model $model, bool $like): void
    {
        if (!Auth::guard('metin2')->check()) {
            return;
        }
        $user = Auth::guard('metin2')->user();

        $reaction = $model->reactions()->where('user_id', $user->id)->first();
        $type = $like ? 'like' : 'dislike';

        if (!$reaction) {
            $model->reactions()->create(['user_id' => $user->id, 'reaction' => $type]);
            $model->increment($like ? 'likes' : 'dislikes');
            return;
        }

        if ($reaction->reaction === $type) {
            return;
        }

        $reaction->reaction = $type;
        $reaction->save();

        if ($like) {
            $model->increment('likes');
            $model->decrement('dislikes');
        } else {
            $model->increment('dislikes');
            $model->decrement('likes');
        }
    }
}
