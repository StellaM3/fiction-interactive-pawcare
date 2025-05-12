<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    public function register(): void
    {
        $this->renderable(function (Throwable $e, $request) {
            if ($request->is('api/*')) {
                if ($e instanceof ValidationException) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Validation failed',
                        'errors' => $e->errors()
                    ], 422);
                }

                if ($e instanceof ModelNotFoundException) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Resource not found'
                    ], 404);
                }

                if ($e instanceof NotFoundHttpException) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Endpoint not found'
                    ], 404);
                }

                if ($e instanceof ApiException) {
                    return response()->json([
                        'status' => 'error',
                        'message' => $e->getMessage()
                    ], $e->getStatusCode());
                }

                return response()->json([
                    'status' => 'error',
                    'message' => 'An unexpected error occurred',
                    'debug' => config('app.debug') ? $e->getMessage() : null
                ], 500);
            }
        });
    }
}