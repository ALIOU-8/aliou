<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\CfuMiddleware;
use App\Http\Middleware\GuestMiddleware;
use App\Http\Middleware\LicencePatenteMiddleware;
use App\Http\Middleware\ToutDroitMiddelware;
use App\Http\Middleware\TpuMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin' => AdminMiddleware::class,
            'cfu'=>CfuMiddleware::class,
            'tpu'=>TpuMiddleware::class,
            'lpt'=>LicencePatenteMiddleware::class,
            'all'=>ToutDroitMiddelware::class,
            'auth'=>AuthMiddleware::class,
            'guest'=>GuestMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
