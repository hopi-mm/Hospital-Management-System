<?php

namespace App\Traits;

trait HttpResponse{

      protected function success($status,$data, $message, $code)
    {
        return response()->json([
            'status' => $status,
            'statusCode' => $code,
            'message' => $message,
            'data' => $data
        ],$code);
    }

    // Http response for fail case
    protected function fail($status, $data, $message, $code){
        return response()->json([
            'status' => $status,
            'statusCode' => $code,
            'message' => $message,
            'data' => $data
        ],$code);
    }
}
