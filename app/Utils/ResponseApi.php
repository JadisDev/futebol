<?php

namespace App\Utils;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * ResponseApi
 */
abstract class ResponseApi
{
    /**
     * @param string $message
     * @param $data
     * @param int $httpCode
     * @return JsonResponse
     */
    public static function success(
        array $data = [],
        string $message = "Requisição realizada com sucesso.",
        int $httpCode = Response::HTTP_OK
    ): JsonResponse {
        return self::json($message, $data, $httpCode);
    }

    /**
     * @param string $message
     * @param $data
     * @param int $httpCode
     * @return JsonResponse
     */
    public static function warning(
        array $data = [],
        string $message = "Atenção requisição inválida.",
        int $httpCode = Response::HTTP_BAD_REQUEST
    ): JsonResponse {
        return self::json($message, $data, $httpCode);
    }

    /**
     * @param string $message
     * @param $data
     * @param int $httpCode
     * @return JsonResponse
     */
    public static function error(
        array $data = [],
        string $message = "Ocorreu uma inconsistência no sistema.",
        int $httpCode = Response::HTTP_INTERNAL_SERVER_ERROR
    ): JsonResponse {
        return self::json($message, $data, $httpCode);
    }

    /**
     * @param string $message
     * @param [type] $data
     * @param int $httpCode
     * @return JsonResponse
     */
    private static function json(
        string $message,
        array $data,
        int $httpCode
    ): JsonResponse {
        return response()->json(
            [
                'code'    => $httpCode,
                'message' => $message,
                'data'    => $data,
            ],
            $httpCode,
            ['Content-Type' => 'application/json;charset=UTF-8', 'Charset' => 'utf-8'],
            JSON_UNESCAPED_UNICODE
        );
    }
}
