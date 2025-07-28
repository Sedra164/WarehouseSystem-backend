<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            ['name' => 'رز مصري', 'sku' => 'SKU-001', 'description' => 'رز أبيض نخب أول', 'unit_id' => 1, 'category_id' => 1],
            ['name' => 'سكر ناعم', 'sku' => 'SKU-002', 'description' => 'سكر ناعم للتعبئة', 'unit_id' => 1, 'category_id' => 1],
            ['name' => 'منظف أرضيات', 'sku' => 'SKU-003', 'description' => 'منظف برائحة اللافندر', 'unit_id' => 3, 'category_id' => 4],
            ['name' => 'مكواة بخار', 'sku' => 'SKU-004', 'description' => 'مكواة كهربائية للبخار', 'unit_id' => 2, 'category_id' => 2],
            ['name' => 'قميص رجالي', 'sku' => 'SKU-005', 'description' => 'قميص قطن مريح', 'unit_id' => 2, 'category_id' => 3],
            ['name' => 'دفتر 80 ورقة', 'sku' => 'SKU-006', 'description' => 'دفتر مدرسي', 'unit_id' => 2, 'category_id' => 5],
            ['name' => 'إبرة طبية', 'sku' => 'SKU-007', 'description' => 'إبرة معقمة للاستخدام مرة واحدة', 'unit_id' => 2, 'category_id' => 6],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }


}
