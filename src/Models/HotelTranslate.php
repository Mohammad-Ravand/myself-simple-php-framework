<?php

namespace App\Models;

use App\Models\Model;

class HotelTranslate extends Model
{
    protected $table = "hotel_translate";


    public function getHotes(int $language_id, int $hotel_id): array
    {
        $condition = "";
        
        if ($language_id > 0 && $hotel_id > 0) {
            $condition = " WHERE language_id= {$language_id} AND hotel_id = {$hotel_id}";
        } else if ($language_id > 0) {
            $condition = " WHERE language_id= {$language_id} ";
        } else if ($hotel_id > 0) {
            $condition = " WHERE hotel_id = {$hotel_id}";
        } else {
        }



        $hotels = $this->query->query("select * from {$this->table}  {$condition}", []);

        return ($hotels->fetchAll());
    }
}
