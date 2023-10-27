<?php
namespace App\Routes;


use App\Routes\Route;
use App\Controllers\HotelController;

$route = new Route();

$route->get('/hotel',[HotelController::class=>'show']);




$route->call();