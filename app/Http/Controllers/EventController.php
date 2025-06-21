<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventComment;
use App\Models\Reaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::orderBy('start_date', 'desc')->get();
        return view('events.index', compact('events'));
    }

    public function show(Event $event)
    {
        $comments = $event->comments()->latest()->get();
        return view('events.show', compact('event', 'comments'));
    }

    public function comment(Request $request, Event $event)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $event->comments()->create([
            'author' => $request->input('author'),
            'content' => $request->input('content'),
        ]);

        return redirect()->back();
    }

    public function like(EventComment $comment)
    {
        $this->react($comment, true);
        return redirect()->back();
    }

    public function dislike(EventComment $comment)
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
