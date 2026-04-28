<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    \App\Models\Transaction::create([
        'order_number' => 'ORD-20260428-001',
        'customer_id'  => 2, 
        'book_id'      => 1, 
        'total_amount' => 150000.00
    ]);
}
}
