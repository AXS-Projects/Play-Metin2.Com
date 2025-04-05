<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

class GuildsMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Conectăm la baza de date 'player' și preluăm top 5 bresle, excluzând "GM"
        $guilds = DB::connection('player')
            ->table('guild')
            ->select('id', 'name', 'level', 'ladder_point')
            ->where('name', '!=', 'GM') // ✅ Excludem breslele cu numele "GM"
            ->orderByDesc('ladder_point') // Clasament după puncte
            ->limit(5)
            ->get();

        // Facem variabila $guilds disponibilă în toate view-urile
        View::share('guilds', $guilds);

        return $next($request);
    }
}

