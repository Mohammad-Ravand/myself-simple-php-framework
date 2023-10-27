<?php

namespace App\Config;

use Exception;

class   Config
{
    public $root_dir;

    private array $configs;
    public function __construct()
    {
        $this->root_dir = './';
        $this->loadConfigs();
    }

    private function loadConfigs()
    {
        $path    = $this->root_dir.'/src/Config/';
        $files = scandir($path);
        $files = array_diff(scandir($path), array('.', '..','Config.php'));
        
        foreach($files as $file){
            $config_array = require_once($path .'/'. $file);
            $config_name =  str_replace('.php', '', $file);
            $this->configs[$config_name] = $config_array;
        }
            
    }

    public function get($name){
        $name = explode('.', $name);
        
        $config_file_name = $name[0];

        $file_exist = array_key_exists($config_file_name,$this->configs);

        if(!$file_exist){
            return new Exception('config file not exist');
        }

        $stack = $this->configs[$config_file_name];
        
        $config_names = array_splice($name,1);


        foreach ($config_names as $key => $config_name) {
            // check is exist
            $key_exist = array_key_exists($config_name,$stack);

            if(!$key_exist){
                return new Exception('config key name '.$config_name.' not exist');
            }

            $stack = $stack[$config_name];
        }

        return $stack;
        

        
    }
}
