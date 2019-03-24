<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public static function successResponse($msg, $data = [], $status = 200)
    {
        return response()->json([
            'data' => $data,
            'msg' => $msg,
            'status' => true,
        ], $status);
    }

    public static function errorResponse($msg, $data = [], $status = 200)
    {
        return response()->json([
            'data' => $data,
            'msg' => $msg,
            'status' => false,
        ], $status);
    }
}
