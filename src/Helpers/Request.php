<?php
namespace App\Helpers;

class Request {

    public static function method():string|null{
        try {
            return strtolower($_SERVER['REQUEST_METHOD']);
        } catch (\Throwable $th) {
            //throw $th;
            return null;
        }
    }    

    public static function params(){
        
    }

    public static function url():string|null{
        $urlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        if(empty($urlPath)){
            return null;
        }

        return $urlPath;
    }
}