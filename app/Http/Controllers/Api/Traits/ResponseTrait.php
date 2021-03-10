<?php

namespace App\Http\Controllers\Api\Traits;

trait ResponseTrait
{
    public function toSuccess(array $data, string $message = 'Success', int $code = 200)
    {
        return response()->json([
            'status' => true,
            'message' => $message ?: 'Success',
            'data' => $data,
        ])->setStatusCode($code);
    }

    public function toFailure(string $message, int $code = 400, array $data = [])
    {
        return response()->json([
            'status' => false,
            'message' => $message ?: 'Failure',
            'data' => $data,
        ])->setStatusCode($code);
    }
}
