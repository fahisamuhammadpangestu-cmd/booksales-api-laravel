<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// TAMBAHKAN BARIS INI:
use App\Models\Book; 

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $books = [
            ['title' => 'Pulang', 'description' => 'Tentang perjalanan.', 'price' => 45000, 'stock' => 10],
            ['title' => 'Laskar Pelangi', 'description' => 'Mimpi anak Belitung.', 'price' => 50000, 'stock' => 15],
            ['title' => 'Bumi', 'description' => 'Dunia paralel.', 'price' => 60000, 'stock' => 20],
            ['title' => 'Filosofi Kopi', 'description' => 'Kumpulan cerita.', 'price' => 35000, 'stock' => 5],
            ['title' => 'Negeri 5 Menara', 'description' => 'Kehidupan pesantren.', 'price' => 40000, 'stock' => 12],
        ];

        foreach ($books as $data) { 
            Book::create($data); 
        }
    }
}