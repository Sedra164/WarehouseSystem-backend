<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $partners = [
            ['name' => 'شركة الأمل',                 'type' => 'supplier',  'phone' => '0999999999',  'email' => 'supply@amal.com',          'address' => 'دمشق - المزة'],
            ['name' => 'مؤسسة النجاح',              'type' => 'customer',  'phone' => '0933333333',  'email' => 'client@najah.com',         'address' => 'حلب - الجميلية'],
            ['name' => 'شركة الأمل التجارية',        'type' => 'supplier',  'phone' => '0991112233',  'email' => 'info@amaltrading.com',     'address' => 'دمشق - باب شرقي'],
            ['name' => 'مؤسسة النجاح للتوريد',      'type' => 'supplier',  'phone' => '0933344556',  'email' => 'supply@najah.org',         'address' => 'حلب - الفرقان'],
            ['name' => 'شركة البناء الحديثة',       'type' => 'customer',  'phone' => '0956677889',  'email' => 'client@modernbuild.com',   'address' => 'اللاذقية - الرمل الجنوبي'],
            ['name' => 'مؤسسة الغذاء المثالي',      'type' => 'supplier',  'phone' => '0945566778',  'email' => 'contact@perfectfood.com',  'address' => 'طرطوس - حي الفتاحي'],
            ['name' => 'سوبرماركت الأمل',            'type' => 'customer',  'phone' => '0988112233',  'email' => 'support@alamalmarket.com', 'address' => 'دمشق - كفرسوسة'],
            ['name' => 'الشركة الوطنية للتوزيع',    'type' => 'supplier',  'phone' => '0933998855',  'email' => 'sales@nationaldist.com',   'address' => 'حماه - شارع ابن رشد'],
            ['name' => 'شركة طيبة التجارية',        'type' => 'customer',  'phone' => '0911223344',  'email' => 'info@tayba.com',           'address' => 'إدلب - الحي الشمالي'],
            ['name' => 'مؤسسة الفرات للمستلزمات',   'type' => 'supplier',  'phone' => '0966778899',  'email' => 'furat@supply.com',         'address' => 'دير الزور - دوار التموين'],
            ['name' => 'بازار المدينة',             'type' => 'customer',  'phone' => '0977889900',  'email' => 'bazaar@madina.com',        'address' => 'درعا - مركز المدينة'],
            ['name' => 'شركة النور للتجارة العامة', 'type' => 'supplier',  'phone' => '0922233445',  'email' => 'info@noortrading.com',     'address' => 'حمص - حي الزهراء'],
        ];

        foreach ($partners as $partner) {
            Partner::create($partner);
        }
    }
}
