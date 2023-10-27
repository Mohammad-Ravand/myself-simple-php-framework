<?php
namespace App\Models;

use App\Models\Model;

class Cafe extends Model{
    protected $table = "cafe";


    public function getHotes():array{
        $hotels = $this->query->query("select * from {$this->table}",[]);
        return ($hotels->fetchAll());
    }
}