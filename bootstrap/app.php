<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',          // Rota web
        api: __DIR__ . '/../routes/api.php',          // Rota API
        commands: __DIR__ . '/../routes/console.php', // Rota de comandos
        health: '/up',                                // Rota de health check
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Configurações de middleware
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Configurações de exceções
    })->create();
