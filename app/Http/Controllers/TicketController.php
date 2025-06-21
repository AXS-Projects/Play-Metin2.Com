<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function index()
    {
        $user = Auth::guard('metin2')->user();
        $tickets = Ticket::where('user_id', $user->id)->latest()->get();
        return view('tickets.index', compact('tickets'));
    }

    public function create()
    {
        return view('tickets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $user = Auth::guard('metin2')->user();

        Ticket::create([
            'user_id' => $user->id,
            'title' => $request->title,
            'message' => $request->message,
        ]);

        return redirect()->route('tickets.index');
    }

    public function show(Ticket $ticket)
    {
        $user = Auth::guard('metin2')->user();
        abort_if($ticket->user_id !== $user->id, 403);
        return view('tickets.show', compact('ticket'));
    }
}
