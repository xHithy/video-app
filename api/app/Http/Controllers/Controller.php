<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

abstract class Controller
{
    public static function incorrectlyFormattedPayload($errors): JsonResponse
    {
        return response()->json([
            'status' => 422,
            'message' => 'Incorrectly formatted payload',
            'errors' => $errors,
        ], 422);
    }
}
