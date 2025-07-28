<?php

namespace Database\Seeders;

use App\Models\Warehouse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $warehouses = [
            ['name' => 'مستودع دمشق', 'description' => 'المخزن الرئيسي في دمشق', 'location' => 'دمشق'],
            ['name' => 'مستودع حلب', 'description' => 'فرع الشمال في حلب', 'location' => 'حلب'],
            ['name' => 'مستودع حمص', 'description' => 'فرع الوسط في حمص', 'location' => 'حمص'],
        ];

        foreach ($warehouses as $warehouse) {
            Warehouse::create($warehouse);
        }
    }

}
