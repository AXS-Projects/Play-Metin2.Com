<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CharacterController extends Controller
{
    public function index()
    {
        $user = Auth::guard('metin2')->user();

        $index = DB::connection('player')
            ->table('player_index')
            ->where('id', $user->id)
            ->first();

        $ids = collect([$index->pid1 ?? null, $index->pid2 ?? null, $index->pid3 ?? null, $index->pid4 ?? null, $index->pid5 ?? null])
            ->filter()
            ->all();

        $characters = [];
        if (!empty($ids)) {
            $characters = DB::connection('player')
                ->table('player')
                ->select('id', 'name', 'level', 'playtime')
                ->whereIn('id', $ids)
                ->orderBy('level', 'desc')
                ->get();
        }

        return view('characters.index', [
            'characters' => $characters,
        ]);
    }

    public function unstuck($id)
    {
        $user = Auth::guard('metin2')->user();

        $index = DB::connection('player')
            ->table('player_index')
            ->where('id', $user->id)
            ->first();

        $ids = collect([
            $index->pid1 ?? null,
            $index->pid2 ?? null,
            $index->pid3 ?? null,
            $index->pid4 ?? null,
            $index->pid5 ?? null,
        ])->filter()->all();

        if (!in_array($id, $ids)) {
            abort(403);
        }

        DB::connection('player')
            ->table('player')
            ->where('id', $id)
            ->update([
                'x' => 469300,
                'y' => 964200,
                'map_index' => 1,
            ]);

        return back()->with('success', __('messages.unstuck_success'));
    }
}
