<?php
namespace App\Helpers;
use function Laravel\Prompts\search;

class ApiResponse
{
    public static function success($data=null, $message = 'Success',$code=200)
    {
        return response()->json([
            'status' => 'Sucess',
            'message' => $message,
            'data'=> $data,
        ], $code);
    }

    public static function error($message='Error',$code=400,$errors=null)
    {

        return  response()->json([
            'status' => 'error',
            'message' => $message,
            'errors' => $errors,
        ], $code);
    }
    public static function notfound($message='Not Found')
    {
        return self::error($message,404);
    }
    public static function unauthorized($message='Unauthorized')
    {
        return self::error($message,401);
    }
}
