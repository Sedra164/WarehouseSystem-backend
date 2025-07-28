<?php

namespace Database\Seeders;

use App\Models\Document;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $documents = [
            [
                'type'                 => 'purchase',
                'date'                 => Carbon::now()->subDays(5),
                'notes'                => 'شراء من المورد',
                'warehouse_product_id' => 2,
                'warehouse_user_id'    => 1,
                'partner_id'           => 1
            ],
            [
                'type'                 => 'sale',
                'date'                 => Carbon::now()->subDays(2),
                'notes'                => 'بيع للعميل',
                'warehouse_product_id' => 1,
                'warehouse_user_id'    => 2,
                'partner_id'           => 2
            ],
            [
                'type'                 => 'waste',
                'date'                 => Carbon::now()->subDay(),
                'notes'                => 'تلف مخزني',
                'warehouse_product_id' => 3,
                'warehouse_user_id'    => 2,
                'partner_id'           => null
            ]
        ];

        foreach ($documents as $doc) {
            Document::create($doc);
        }

    }
}
