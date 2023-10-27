<?php
namespace App\Routes;

use Exception;
use App\Helpers\Request;
use App\Routes\RouteBinding;

class Route{

    

    private RouteBinding $routeBinding;

    public  function __construct(){
        $this->routeBinding = new RouteBinding();
    }

    public  function get(string $url_path, array $binding):void{
        // self::$bindings[$url_path] = $binding;
        $this->routeBinding->bind('get',$url_path,$binding);
    }

    public  function post(string $url_path, array $binding):void{
        $this->routeBinding->bind('post',$url_path,$binding);
    }

    public  function put(string $url_path, array $binding):void{
        $this->routeBinding->bind('put',$url_path,$binding);
    }

    public  function delete(string $url_path, array $binding):void{
        $this->routeBinding->bind('delete',$url_path,$binding);
    }


    

    public  function call(){
        if(array_key_exists("REQUEST_METHOD", $_SERVER)==false){
            return;
        }

        $url_path = Request::url();
        if($url_path==null){
            throw new Exception("url does not regestered in route list",1);
        }

        $method = Request::method();
        $this->routeBinding->resolve($method,$url_path);
    }
}