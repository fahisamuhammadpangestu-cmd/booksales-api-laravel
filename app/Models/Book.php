<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Book;

class Book extends Model
{
   // Properti untuk menampung data dummy
    private $books = [
        [
            'title' => 'Pulang',
            'description' => 'Petualangan seorang pemuda.',
            'price' => 40000,
            'stock' => 15
        ],
        [
            'title' => 'Sebuah Seni',
            'description' => 'Kehidupan dan filosofi.',
            'price' => 25000,
            'stock' => 5
        ]
    ];

    // Method untuk mengirim data ke luar (Controller)
    public function getBooks() {
        return $this->books;
    }
    
    protected $fillable = [
    'title', 
    'description', 
    'price', 
    'stock', 
    'cover', 
    'genre_id', 
    'author_id'
];
}
