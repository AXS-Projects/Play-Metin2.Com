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
            ->where('account_id', $user->id)
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
}
