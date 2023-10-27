<?php
namespace App;
use Dotenv\Dotenv;
use App\Config\Config;
use App\Routes\Routes;
use App\Providers\Provider;

class App{
    private Config $config;
    private Provider $provider;

    private array $routes;
    public function __construct(){
        $this->loadEnv();
        $this->loadConfig();
        $this->loadProviders();
        $this->loadRoutes();

        // $route->call();
        
    }

    private function loadEnv(){
        $dotenv = Dotenv::createImmutable(__DIR__);
        $dotenv->load();
    }

    private function loadConfig(){
        $this->config = new Config();
    }

    private function loadRoutes(){
        require_once('./src/Routes/Routes.php');
    }
    private function loadModels(){

    }

    private function loadProviders(){
       $this->provider = new Provider($this->config);
    }

    public function loadControllers(){

    }
   

    
}