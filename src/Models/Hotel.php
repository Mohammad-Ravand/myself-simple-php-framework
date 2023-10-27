<?php
namespace App\Models;

use App\Models\Model;

class Hotel extends Model{
    protected $table = "hotel";


    public function getHotes():array{
        
        $hotels = $this->query->query("select * from {$this->table}",[]);
        return ($hotels->fetchAll());
    }
}