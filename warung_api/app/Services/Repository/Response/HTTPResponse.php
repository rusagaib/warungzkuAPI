<?php

namespace App\Services\Repository\Response;

use Symfony\Component\HttpFoundation\Response;


class HTTPResponse
{
    public static function statusText($code): string
    {
        return Response::$statusTexts[$code];
    }

    public static function message($code): string
    {
        return (string) $code.' - '.self::statusText($code);
    }

    public static function result($response, $jsonData)
    {
        return [
            'status' => true,
            'code' => $response->status,
            'message' => self::message($response->status),
            'data' => $jsonData
        ];
    }
    
    public static function error($response, $jsonData)
    {
        // cek if manual init available
        $status = $response->status ?? false;

        // manual init $status = (object)["status" => 404];
        if ($status != false)
        {
            return [
                'status' => false,
                'code' => $response->status,
                'message' => self::message($response->status),
                'error' => $jsonData
            ];

        }

        // return if response builder ->status() true
        return [
            'status' => false,
            'code' => $response->status(),
            'message' => self::message($response->status()),
            'error' => $jsonData
        ];
    }

    

}