<?php

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
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (Illuminate\Validation\ValidationException $e, $request) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Validation failed',
                'errors'  => $e->errors(),
            ], 422);
        });

        // Handle authentication errors (401)
        $exceptions->render(function (Illuminate\Auth\AuthenticationException $e, $request) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Unauthorized access. Token missing or invalid.',
            ], 401);
        });

        // Handle authorization errors (403)
        $exceptions->render(function (Illuminate\Auth\Access\AuthorizationException $e, $request) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Forbidden. You are not allowed to perform this action.',
            ], 403);
        });

        // Handle model not found errors (404)
        $exceptions->render(function (Illuminate\Database\Eloquent\ModelNotFoundException $e, $request) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Resource not found.',
            ], 404);
        });

        // Handle route not found (404)
        $exceptions->render(function (Symfony\Component\HttpKernel\Exception\NotFoundHttpException $e, $request) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Endpoint not found.',
            ], 404);
        });

        // Handle Method Not Allowed (405)
        $exceptions->render(function (Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException $e, $request) {
            return response()->json([
                'status'  => 'error',
                'message' => 'HTTP method not allowed.',
            ], 405);
        });

        // Handle all other unhandled exceptions (500)
        $exceptions->render(function (Throwable $e, $request) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Something went wrong. Please try again later.',
                'debug'   => config('app.debug') ? $e->getMessage() : null,
            ], 500);
        });
    })->create();
