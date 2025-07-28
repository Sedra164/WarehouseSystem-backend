<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\WarehouseUser;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            UnitSeeder::class,
            WarehouseSeeder::class,
            ProductSeeder::class,
            WarehouseProductSeeder::class,
            UserSeeder::class,
            WarehouseUserSeeder::class,
            PartnerSeeder::class,
            DocumentSeeder::class,
            DocumentLineSeeder::class
        ]);
    }
}
