<?php
namespace App\Controllers;

use App\Controllers\Controller;
use App\Config\Config;
use App\Helpers\Response;
use App\Models\HotelTranslate;

class   HotelTranslateController extends Controller{
    private HotelTranslate $hotel_translate;
    public function __construct( private Config $config){
        $this->hotel_translate = new HotelTranslate();
    }

    public function index(){
        echo 'running index from index';
    }
    
    public function show(){

        $language_id =(int)($_GET['language_id'] ?? null);
        $hotel_id = (int)($_GET['hotel_id'] ?? null);

        $data = $this->hotel_translate->getHotes($language_id,$hotel_id);

        
        $response_data = [
            'data'=>$data,
            'statusCode'=>200,
            'error'=>[
                'code'=>null,
                'message'=> null
            ]
            ];

        Response::json($response_data)->status(200)->header('Content-Type','application/json')->send();
    }
}