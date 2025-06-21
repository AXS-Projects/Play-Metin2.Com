<?php
namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class ServerController extends Controller
{
    public function status(): JsonResponse
    {
        $host = config('server.host');
        $port = config('server.port');
        $timeout = config('server.timeout', 1);

        $online = false;
        $connection = @fsockopen($host, $port, $errno, $errstr, $timeout);
        if ($connection) {
            $online = true;
            fclose($connection);
        }

        $playersOnline = null;
        try {
            $schema = DB::connection('player')->getSchemaBuilder();
            if ($schema->hasColumn('player', 'is_login')) {
                $playersOnline = DB::connection('player')->table('player')->where('is_login', 1)->count();
            } elseif ($schema->hasColumn('player', 'is_online')) {
                $playersOnline = DB::connection('player')->table('player')->where('is_online', 1)->count();
            }
        } catch (\Throwable $e) {
            $playersOnline = null;
        }

        return response()->json([
            'online' => $online,
            'players_online' => $playersOnline,
            'uptime' => null,
        ]);
    }
}
