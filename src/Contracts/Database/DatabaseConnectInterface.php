<?php
namespace App\Contracts\Database;

class DatabaseConnectInterface{
    public function __construct(){}
    public function getConnection(){}
}