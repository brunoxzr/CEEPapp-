<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function ($middleware) {

        // Middleware globais (se quiser)
        // $middleware->append(\App\Http\Middleware\AlgumMiddleware::class);

        // Middleware nomeados (SUBSTITUI O KERNEL)
        $middleware->alias([
            'admin'      => \App\Http\Middleware\AdminAuthMiddleware::class,
            'diretor'    => \App\Http\Middleware\DiretorOnly::class,
            'permissao'  => \App\Http\Middleware\HasPermissao::class,
        ]);
    })

    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
