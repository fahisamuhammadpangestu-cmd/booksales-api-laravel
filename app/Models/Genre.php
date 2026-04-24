<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
   private $genres = [
        ['id' => 1, 'name' => 'Fiksi'],
        ['id' => 2, 'name' => 'Non-Fiksi'],
        ['id' => 3, 'name' => 'Misteri'],
        ['id' => 4, 'name' => 'Petualangan'],
        ['id' => 5, 'name' => 'Biografi']
    ];

    public function getGenres() {
        return $this->genres;
    }
}
