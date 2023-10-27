<?php
namespace App\Routes;

use Exception;
use App\Helpers\Request;
use App\Helpers\Reflection;

class   RouteBinding{

    private  array $bindings;

    public function __construct(){
        $this->bindings = [];
    }
    private function checkBinding(string $method,string $url_path,array $binding):void{
        $url_path_split = explode("/", $url_path);

        $method = Request::method();
        
        if($method !=$method){
            throw new Exception("not allowed request method", 1);
            
        }
 
        $class_name = array_key_first($binding);
        $method_name = $binding[$class_name];

        // do binding
        if (!class_exists($class_name)) {
            throw new Exception("class {$class_name} does not exist",1);
            
        }

        $dependencies = Reflection::getClassDependencies($class_name);
        foreach ($dependencies as $key => $dependency) {
            // $dependency = str_replace(['App','\\'],'src', $dependency);
            // $dependency_path = './'.$dependency.'.php';
            // exit($dependency_path);
            
            // require_once($dependency_path);
            $dependencies[$key] = new $dependency();

        }

        //create instance
        // $init = call_user_func_array([new $class_name, '__construct'], $dependencies);

        // var_dump($init);
        // exit();
        $init = new $class_name(...$dependencies);

        if(!method_exists($init,$method_name)){
            throw new Exception("method {$method_name} does not exist in class {$class_name}",1);
            
        }

    }
    public function bind(string $method,string $url_path, array $binding):void{
        $this->checkBinding($method,$url_path,$binding);
        $this->bindings[$method][$url_path] = $binding;
    }

    private function checkBeforeResolve(string $method,string $url_path):void{
        try {
            $binding = $this->bindings[$method][$url_path];
            if(!is_array($binding)){
                throw new Exception("",1);
            }
        } catch (\Throwable $th) {
            // throw $th;
            throw new Exception("route does not resolved");
        }

    }

    public function resolve(string $method,string $url_path){
        $this->checkBeforeResolve($method,$url_path);

        $binding = $this->bindings[$method][$url_path];
        if(!$binding){
            throw new Exception("url_path does not registered in routes list",1);
        }

        $class_name = array_key_first($binding);
        $method_name = $binding[$class_name];
        
        $dependencies = Reflection::getClassDependencies($class_name);
        foreach ($dependencies as $key => $dependency) {
            // $dependency = str_replace(['App','\\'],'src', $dependency);
            // $dependency_path = './'.$dependency.'.php';
            // exit($dependency_path);
            
            // require_once($dependency_path);
            $dependencies[$key] = new $dependency();

        }


        $init = new $class_name(...$dependencies);
        
        $init->$method_name();
    }

    

    
}