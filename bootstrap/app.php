<?php

use App\Http\Middleware\EnsureResidentBelongsToCondominium;
use App\Http\Middleware\ForceHttps;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'resident' => EnsureResidentBelongsToCondominium::class,
        ]);

        $middleware->prepend(ForceHttps::class);

        $middleware->redirectGuestsTo(fn () => route('resident.login'));

        $middleware->redirectUsersTo(function (Request $request) {
            $condominium = $request->user()?->condominium;

            return $condominium
                ? route('resident.dashboard', ['condominium' => $condominium->slug])
                : '/admin';
        });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*') || $request->expectsJson(),
        );
    })->create();
