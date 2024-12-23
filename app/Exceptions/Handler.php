<?php

namespace App\Exceptions;

use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Http\JsonResponse;
use Throwable;

class Handler extends ExceptionHandler
{
    public function render($request, Throwable $exception): JsonResponse
    {
        $statusCode = $exception instanceof HttpException ? $exception->getStatusCode() : 500;
        $message = $exception->getMessage() ?: 'Internal Server Error';

        return response()->json([
            'success' => false,
            'message' => $message,
            'status_code' => $statusCode
        ], $statusCode);
    }
}
