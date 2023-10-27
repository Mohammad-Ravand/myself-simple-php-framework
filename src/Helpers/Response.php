<?php
namespace App\Helpers;

class Response{

    private static $body;
    private static $status;

    private static  $headers;

    public static function header(string $header, string $content):self{
        self::$headers[ $header]= $content;
        return new self();

    }
    
    public static function content(mixed $content):self{
        self::$body= $content;
        return new self();
    }

    public static function status(string $status):self{
        self::$status = $status;
        return new self();

    }


    public static function json(array $data):self{
        self::$body = $data;
        self::$headers["Content-Type"] = "application/json";

        self::$body = json_encode(self::$body,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
        return new self();
    }

    public static function send(){
        if(self::$headers){
            foreach(self::$headers as $key => $value){
                // Set headers
                header("{$key}:{$value}");
            }
        }

        // Set status code
        http_response_code(self::$status);

        
        echo self::$body;

        // self::$headers = [ ];
        // self::$body = [];
        // self::$status = 200;
    }
    
}