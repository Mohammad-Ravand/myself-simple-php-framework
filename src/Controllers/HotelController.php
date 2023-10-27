<?php
namespace App\Controllers;

use App\Controllers\Controller;
use App\Config\Config;
use App\Helpers\Response;

class   HotelController extends Controller{
    public function __construct( private Config $config){

    }

    public function index(){
        echo 'running index from index';
    }
    
    public function show(){
        $data = [
            'name'=>'mohammad',
            'age'=>27
        ];

        Response::json($data)->status(200)->header('Content-Type','application/json')->send();
    }
}