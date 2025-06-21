<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    public function topPlayers(Request $request)
    {
        // Obține parametrii de filtrare din cererea HTTP
        $name = $request->input('name');
        $minLevel = $request->input('min_level');
        $maxLevel = $request->input('max_level');
        $minPlaytime = $request->input('min_playtime');
        $maxPlaytime = $request->input('max_playtime');

        // Specifică conexiunea pentru baza de date a jucătorilor
$query = DB::connection('player')
    ->table('player as p')
    ->select(
        'p.name as player_name', // Evităm ambiguitatea
        'p.level', 
        'p.playtime', 
        DB::raw('COALESCE(p.killed_monster, 0) as killed_monster'), 
        DB::raw('COALESCE(SUM(i.count), 0) as golden_bars'),
        DB::raw('COALESCE(pi.empire, 3) as empire'), // Dacă nu se găsește, e implicit 3
        DB::raw('COALESCE(g.name, "N/A") as guild_name') // Evităm ambiguitatea
    )
    ->leftJoin('item as i', function($join) {
        $join->on('p.id', '=', 'i.owner_id')
             ->where('i.vnum', '=', 80005);
    })
    ->leftJoin('player_index as pi', function($join) {
        $join->on('p.id', '=', 'pi.pid1')
             ->orOn('p.id', '=', 'pi.pid2')
             ->orOn('p.id', '=', 'pi.pid3')
             ->orOn('p.id', '=', 'pi.pid4')
             ->orOn('p.id', '=', 'pi.pid5');
    })
    ->leftJoin('guild_member as gm', 'p.id', '=', 'gm.pid') 
    ->leftJoin('guild as g', 'gm.guild_id', '=', 'g.id') 
    ->where('p.name', 'NOT LIKE', '%[%') // Prefixăm corect
    ->where('p.name', 'NOT LIKE', '%]%') // Prefixăm corect
    ->groupBy('p.id', 'player_name', 'p.level', 'p.playtime', 'p.killed_monster', 'pi.empire', 'guild_name') // Folosim aliasurile corecte
    ->orderByDesc('p.level')
    ->orderBy('p.name', 'asc')
    ->orderByDesc('p.playtime');

// Aplică filtrele
if ($name) {
    $query->where('p.name', 'like', '%' . $name . '%'); // Prefix corect
}
if ($minLevel) {
    $query->where('p.level', '>=', $minLevel);
}
if ($maxLevel) {
    $query->where('p.level', '<=', $maxLevel);
}
if ($minPlaytime) {
    $query->where('p.playtime', '>=', $minPlaytime);
}
if ($maxPlaytime) {
    $query->where('p.playtime', '<=', $maxPlaytime);
}

// Paginație
$players = $query->paginate(20);

// Modifică jucătorii pentru a adăuga iconițele pentru primele 3 locuri
$players->transform(function ($player, $index) {
    $icons = ['🥇', '🥈', '🥉'];
    $player->rank = $index < 3 ? $icons[$index] : ($index + 1); 
    return $player;
});

// Returnează viziunea cu jucătorii și filtrele
return view('top-players', [
    'players' => $players,
    'name' => $name,
    'minLevel' => $minLevel,
    'maxLevel' => $maxLevel,
    'minPlaytime' => $minPlaytime,
    'maxPlaytime' => $maxPlaytime,
    'title' => 'Top Players',
]);

    }
}
