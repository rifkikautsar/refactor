<?php

namespace App\Response;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Psr7\Response;

class ApiResponse {  
    
    /**
     * set headers
     * @return array
     */
    private static function prepareHeaders(): array {
        return [
            'Access-Control-Allow-Origin' => '*',
            'Content-Type' => 'application/json',
        ];
    }
    
    /**
     * create response
     * @return ResponseInterface
     */
    public static function create(int $code, string $message, $data = null): ResponseInterface {
        $headers = self::prepareHeaders();
        $response = [
            'code' => $code,
            'message' => $message,
            'data' => $data,
        ];

        return new Response($code,$headers,json_encode($response));
    }
}