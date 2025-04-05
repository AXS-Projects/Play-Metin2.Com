<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

class TopPlayersMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Preluăm Top 10 jucători din baza de date
        $players = DB::connection('player')
            ->table('player')
            ->select(
                'name as player_name',
                'level', 
                'playtime'
            )
            ->where('name', 'not like', '%[%') // Exclude players with '[' in name
            ->where('name', 'not like', '%]%') // Exclude players with ']' in name
            ->orderByDesc('level')
            ->orderBy('name', 'asc')
            ->orderByDesc('playtime')
            ->limit(10)
            ->get()
            ->map(function ($player, $index) {
                $icons = ['🥇', '🥈', '🥉'];
                $player->rank = $index < 3 ? $icons[$index] : ($index + 1);
                return $player;
            });

        // Facem variabila $players disponibilă global
        View::share('players', $players);

        return $next($request);
    }
}
