<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
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

    public function dataSource(Request $request)
    {
        $from = $request->query('from');
        if (!$from) $from = "local";

        return response('Konfigurasi Data Berhasil Diubah!')->cookie('data-source', $from, 60);
    }
}
