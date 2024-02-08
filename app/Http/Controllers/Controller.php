<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function responseJson($status = "success", $code = 200, $message = null, $data = null)
    {
        return response()->json([
            'code' => $code,
            'status' => $status,
            'message' => $message,
            'timestamp' =>  \Carbon\Carbon::now(),
            'data' => $data,
        ], $code);
    }
}
