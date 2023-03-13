<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    /**
     *  return response format method     * 
     * @return \Illuminate\Http\Response
     */

     public function sendResponse($headerMessage, $message, $code, $data = []) 
     {
        $response = [
            'headerMessage' => $headerMessage,
            'message' => $message,
            'data' => $data
        ];

        return response()->json($response, $code);

     }
}
