<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Author;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $authors = [
        ['name' => 'Tere Liye', 'city' => 'Jakarta'],
        ['name' => 'Dee Lestari', 'city' => 'Bandung'],
        ['name' => 'Andrea Hirata', 'city' => 'Belitung'],
        ['name' => 'Pramoedya Ananta Toer', 'city' => 'Blora'],
        ['name' => 'Ahmad Fuadi', 'city' => 'Maninjau'],
    ];
    foreach ($authors as $data) { Author::create($data); }
    }
}
