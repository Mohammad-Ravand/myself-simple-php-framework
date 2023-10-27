<?php
namespace App\Routes;


use App\Routes\Route;
use App\Controllers\HotelController;
use App\Controllers\HotelTranslateController;

$route = new Route();

$route->get('/hotel',[HotelController::class=>'show']);
$route->get('/hotelTranslate',[HotelTranslateController::class=>'show']);




$route->call();