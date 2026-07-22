<?php

use App\Http\Middleware\AgentDiscovery;
use App\Http\Middleware\MarkdownNegotiation;
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
        // Agent readiness: markdown content negotiation + discovery Link headers.
        $middleware->web(append: [
            MarkdownNegotiation::class,
            AgentDiscovery::class,
        ]);

        // The hosted MCP endpoint is a public JSON-RPC API — no CSRF token.
        $middleware->validateCsrfTokens(except: ['mcp']);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*'),
        );
    })->create();
