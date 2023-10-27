<?php
namespace App\Providers;

use App\Config\Config;

class   Provider{

    private array $providers;
    
    public function __construct(private Config $config){
        $this->loadProviders();
    }

    private function loadProviders()
    {
        $path    = $this->config->root_dir.'/src/Providers';
        $files = scandir($path);
        $files = array_diff(scandir($path), array('.', '..','Provider.php','AbstractProvider.php'));
        
        foreach($files as $file){
            require_once($path .'/'. $file);
            $provider_name =  str_replace('.php', '', $file);
            $provider_name = '\\App\Providers\\'.$provider_name;
            
            $provider_obj = new $provider_name();
            $this->providers[$provider_name] = $provider_obj;
        }
            
    }
}