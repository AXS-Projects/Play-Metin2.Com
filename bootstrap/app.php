<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Spatie\Permission\Middleware\RoleMiddleware;
use Spatie\Permission\Middleware\PermissionMiddleware;
use App\Http\Middleware\AdminAccessMiddleware;
use App\Http\Middleware\LanguageMiddleware;
use App\Http\Middleware\GuildsMiddleware;
use App\Http\Middleware\TopPlayersMiddleware;
use App\Http\Middleware\LatestNewsMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Middleware-urile trebuie să ruleze în ordinea corectă
        $middleware->prepend(TopPlayersMiddleware::class);
        $middleware->prepend(GuildsMiddleware::class);
        $middleware->prepend(LatestNewsMiddleware::class);
        $middleware->prepend(LanguageMiddleware::class); // ✅ Limba trebuie setată prima

        // Alias-uri pentru middleware-uri personalizate
        $middleware->alias([
            'admin.access' => AdminAccessMiddleware::class,
            'language' => LanguageMiddleware::class,
            'guilds' => GuildsMiddleware::class, // ✅ Permite utilizarea `->middleware('guilds')` în rute
            'metin2.auth' => \App\Http\Middleware\Metin2AuthMiddleware::class, // ✅ Alias pentru middleware-ul de autentificare Metin2
            'latest.news' => LatestNewsMiddleware::class,

        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
