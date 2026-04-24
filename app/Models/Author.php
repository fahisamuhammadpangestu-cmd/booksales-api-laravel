<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Author;

class Author extends Model
{
    private $authors = [
        ['id' => 1, 'name' => 'Tere Liye', 'city' => 'Jakarta'],
        ['id' => 2, 'name' => 'Dee Lestari', 'city' => 'Bandung'],
        ['id' => 3, 'name' => 'Andrea Hirata', 'city' => 'Belitung'],
        ['id' => 4, 'name' => 'Pramoedya Ananta Toer', 'city' => 'Blora'],
        ['id' => 5, 'name' => 'Ahmad Fuadi', 'city' => 'Maninjau']
    ];

    public function getAuthors() {
        return $this->authors;
    }

    protected $guarded = [];
}
