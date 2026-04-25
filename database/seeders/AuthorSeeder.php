<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;

class AuthorSeeder extends Seeder
{
    public function run(): void
    {
        $authors = [
            [
                'name' => 'Tere Liye',
                'photo' => 'tere_liye.jpg',
            ],
            [
                'name' => 'Dee Lestari',
                'photo' => 'dee_lestari.jpg',
            ],
            [
                'name' => 'Andrea Hirata',
                'photo' => 'andrea_hirata.jpg',
            ],
            [
                'name' => 'Pramoedya Ananta Toer',
                'photo' => 'pramoedya.jpg',
            ],
            [
                'name' => 'Ahmad Fuadi',
                'photo' => 'ahmad_fuadi.jpg',
            ],
        ];

        foreach ($authors as $data) {
            Author::create($data);
        }
    }
}