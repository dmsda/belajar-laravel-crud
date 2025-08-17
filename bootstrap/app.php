<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Middleware global (jika perlu) ditambah di sini
        // Contoh:
        // $middleware->alias([
        //     'admin' => \App\Http\Middleware\AdminMiddleware::class,
        // ]);
        
        // ❌ Jangan pakai $middleware->cors(); di Laravel 11
        // ✅ CORS sudah di-handle otomatis lewat config/cors.php
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Tempat custom handler error
    })
    ->create();
