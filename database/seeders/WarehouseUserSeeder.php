<?php

namespace Database\Seeders;

use App\Models\WarehouseUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WarehouseUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    { $warehouseUsers = [
        ['type' => 'manager', 'warehouse_id' => 1, 'user_id' => 2],
        ['type' => 'manager', 'warehouse_id' => 2, 'user_id' => 3],
        ['type' => 'staff',   'warehouse_id' => 1, 'user_id' => 4],
        ['type' => 'staff',   'warehouse_id' => 2, 'user_id' => 5],
    ];

        foreach ($warehouseUsers as $warehouseUser) {
            WarehouseUser::create($warehouseUser);
        }
    }
}
