<?php
namespace App;
use Dotenv\Dotenv;
use App\Config\Config;
use App\Routes\Routes;
use App\Providers\Provider;
use App\Application\ConfigTrait;

class App{
    private static $instance;

    public static Config $config;
    private Provider $provider;

    private array $routes;
    private function __construct(){
        $this->loadEnv();
        $this->loadConfig();
        $this->loadProviders();
        $this->loadRoutes();

    }
    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function loadEnv(){
        $dotenv = Dotenv::createImmutable(__DIR__);
        $dotenv->load();
    }

    private function loadConfig(){
        self::$config = new Config();
    }

    private function loadRoutes(){
        require_once('./src/Routes/Routes.php');
    }

    private function loadProviders(){
       $this->provider = new Provider(self::$config);
    }

    public function loadControllers(){

    }


   

    
}