<?php
namespace App\Contracts\Database;

interface DatabaseConnectInterface{
    public function getConnection();
}