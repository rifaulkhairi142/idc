<?php

use App\Http\Middleware\Admin;
use App\Http\Middleware\LengkapiProfil;
use App\Http\Middleware\PendaftaranKPM;
use App\Http\Middleware\PendaftaranPPL;
use App\Http\Middleware\Profil;
use App\Http\Middleware\Supervisor;
use App\Http\Middleware\User;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            \App\Http\Middleware\HandleInertiaRequests::class,
            \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,
        ]);

        $middleware->alias([
            'admin' => Admin::class,
            'supervisor' => Supervisor::class,
            'user' => User::class,
            'profil' => Profil::class,
            'open_kpm' => PendaftaranKPM::class,
            'open_ppl' => PendaftaranPPL::class,
            'save_profil' => LengkapiProfil::class,



        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
