<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $units = [
            ['name' => 'كيلوغرام', 'abbreviation' => 'كغ'],
            ['name' => 'قطعة', 'abbreviation' => 'قط'],
            ['name' => 'ليتر', 'abbreviation' => 'ل'],
            ['name' => 'علبة', 'abbreviation' => 'ع'],
            ['name' => 'رزمة', 'abbreviation' => 'ر'],
        ];

        foreach ($units as $unit) {
            Unit::create($unit);

        }
    }
}
