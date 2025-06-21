<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GuildController extends Controller
{
    public function topGuilds(Request $request)
    {
        // Preluăm parametrii de filtrare
        $search = $request->input('name');
        $minLevel = $request->input('min_level');
        $maxLevel = $request->input('max_level');
        $minPoints = $request->input('min_points');
        $maxPoints = $request->input('max_points');
        $minGold = $request->input('min_gold');
        $maxGold = $request->input('max_gold');

        // Construim query-ul cu filtre
        $query = DB::connection('player')
            ->table('guild')
            ->select('id', 'name', 'level', 'ladder_point', 'win', 'loss', 'gold')
            ->where('name', '!=', 'GM'); // Excludem breasla "GM"

        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }

        if ($minLevel) {
            $query->where('level', '>=', $minLevel);
        }

        if ($maxLevel) {
            $query->where('level', '<=', $maxLevel);
        }

        if ($minPoints) {
            $query->where('ladder_point', '>=', $minPoints);
        }

        if ($maxPoints) {
            $query->where('ladder_point', '<=', $maxPoints);
        }

        if ($minGold) {
            $query->where('gold', '>=', $minGold);
        }

        if ($maxGold) {
            $query->where('gold', '<=', $maxGold);
        }

        // Aplicăm ordonarea și paginarea
        $guilds = $query->orderByDesc('ladder_point')->paginate(20);

        return view('top-guilds', [
            'guilds' => $guilds,
            'title' => 'Top Guilds'
        ]);        
    }
}
