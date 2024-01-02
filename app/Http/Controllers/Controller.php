<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    protected function response($status, $data= null, $message = null): \Illuminate\Http\JsonResponse|JsonResource
    {

        $response = [
            'message'=> is_null($message)? Response::$statusTexts[$status] : $message
        ];

        if($data instanceof JsonResource){
            return $data->additional($response);
        }


        $response = !empty($data) ? array_merge($response, ["data"=>$data]) : $response;
        return response()->json($response,$status);

    }
    public function errorResponse($message, $code): \Illuminate\Http\JsonResponse
    {
        return response()->json(['error' => $message, 'code' => $code], $code);
    }
}
