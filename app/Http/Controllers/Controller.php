<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function sendResponse($result, $message, $httpCode = 200)
    {
        $response = [
            'status' => 1,
            'httpCode' => $httpCode,
            'message' => $message,
            'data' => $result,
        ];

        return response()->json($response, $httpCode);
    }
    public function sendError($error, $errorMessages = [], $httpCode = 400)
    {
        $response = [
            'status' => 0,
            'httpCode' => $httpCode,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }
        return response()->json($response, $httpCode);
    }
}
