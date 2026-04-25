<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book; // Import model Book

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $books = [
            [
                'title' => 'Harry Potter',
                'description' => 'Kisah petualangan penyihir muda di sekolah Hogwarts.',
                'price' => 150000,
                'stock' => 10,
                'cover' => 'harry_potter.jpg',
                'genre_id' => 1,
                'author_id' => 1,
            ],
            [
                'title' => 'The Shining',
                'description' => 'Kisah horor psikologis di sebuah hotel terisolasi.',
                'price' => 125000,
                'stock' => 5,
                'cover' => 'the_shining.jpg',
                'genre_id' => 2,
                'author_id' => 2,
            ],
            [
                'title' => 'Laskar Pelangi',
                'description' => 'Perjuangan sepuluh anak di Pulau Belitung untuk bersekolah.',
                'price' => 95000,
                'stock' => 15,
                'cover' => 'laskar_pelangi.jpg',
                'genre_id' => 3,
                'author_id' => 3,
            ],
        ];

        foreach ($books as $data) {
            Book::create($data);
        }
    }
}