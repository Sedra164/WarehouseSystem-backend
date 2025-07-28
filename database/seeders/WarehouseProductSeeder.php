<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WarehouseProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $records = [
            ['warehouse_id' => 1, 'product_id' => 1, 'quantity' => 50,  'min_quantity' => 20],
            ['warehouse_id' => 2, 'product_id' => 2, 'quantity' => 10,  'min_quantity' => 15],
            ['warehouse_id' => 3, 'product_id' => 3, 'quantity' => 60,  'min_quantity' => 30],
            ['warehouse_id' => 1, 'product_id' => 4, 'quantity' => 5,   'min_quantity' => 10],
            ['warehouse_id' => 2, 'product_id' => 5, 'quantity' => 25,  'min_quantity' => 20],
            ['warehouse_id' => 3, 'product_id' => 6, 'quantity' => 7,   'min_quantity' => 10],
            ['warehouse_id' => 1, 'product_id' => 7, 'quantity' => 100, 'min_quantity' => 50],
        ];

        foreach ($records as $record) {
            DB::table('warehouse_products')->insert(array_merge($record, [
                'created_at' => now(),
                'updated_at' => now()
            ]));
        }

    }
}
