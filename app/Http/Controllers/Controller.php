<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Response JSON
     */
    protected function responseJson($payload = null, $code = 200): JsonResponse
    {
        return response()->json([
            'error' => null,
            'payload' => $payload
        ], $code);
    }


    /**
     * Response JSON Error
     */
    protected function responseJsonError($message = '', $payload = null, $code = 400): JsonResponse
    {
        return response()->json([
            'error' => [
                'code' => $code,
                'message' => $message
            ],
            'payload' => $payload
        ], $code);
    }
}
