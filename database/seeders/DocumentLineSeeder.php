<?php

namespace Database\Seeders;

use App\Models\DocumentLines;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentLineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lines = [
            ['document_id' => 1, 'quantity' => 20, 'unit_price' => 1000.50, 'total_price' => 20010],
            ['document_id' => 2, 'quantity' => 10, 'unit_price' => 1500.00, 'total_price' => 15000],
            ['document_id' => 3, 'quantity' => 5, 'unit_price' => 900.00,   'total_price' => 4500],
        ];

        foreach ($lines as $line) {
            DocumentLines::create($line);
        }
    }
}
