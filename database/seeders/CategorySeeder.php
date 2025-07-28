<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'مواد غذائية', 'description' => 'منتجات الطعام اليومية'],
            ['name' => 'أدوات كهربائية', 'description' => 'معدات وأجهزة كهربائية'],
            ['name' => 'ألبسة', 'description' => 'ملابس رجالية ونسائية'],
            ['name' => 'مواد تنظيف', 'description' => 'منظفات ومواد تعقيم'],
            ['name' => 'قرطاسية', 'description' => 'أدوات مكتبية ومدرسية'],
            ['name' => 'أدوية', 'description' => 'منتجات طبية وصيدلانية'],
            ['name' => 'معدات صناعية', 'description' => 'معدات وآلات للورشات والمصانع'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
