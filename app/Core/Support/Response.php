<?php

namespace App\Core\Support;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response as LResponse;

trait Response
{
    /**
     * @param $data
     * @param int $code
     * @param LResponse $httpStatus
     * @return JsonResponse
     */
    protected function successResponse($data, int $code = 1, int $httpStatus = LResponse::HTTP_OK)
    {
        return response()->json([
            'data' => $data,
            'code' => $code
        ], $httpStatus);
    }

    /**
     * @param string $message
     * @param int $code
     * @param LResponse $httpStatus
     * @return JsonResponse
     */
    protected function errorResponse(string $message, int $code, int $httpStatus)
    {
        return response()->json([
            'message' => $message,
            'code' => $code
        ], $httpStatus);
    }
}
