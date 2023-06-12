<?php

use App\Utils\ResponseApi;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class HandlerValidationRequestExecption extends ExceptionHandler
{
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof ValidationException && $request->expectsJson()) {
            return ResponseApi::warning(
                $exception->errors(),
                'Erro de validação',
                JsonResponse::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        if ($exception instanceof Exception && $request->expectsJson()) {
            return ResponseApi::error(
                $request->all()
            );
        }

        return parent::render($request, $exception);
    }
}