<?php

use Illuminate\Database\Seeder;

class CounterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('counters')->insert([
            'title_ar' => 'متجر إلكتروني',
            'title_en' => 'Electronic Shop',
            'count' => '8',
            'numerical_ar' => 'آلاف',
            'numerical_en' => 'Thousands',
            'icon' => '<i class="icon-online-shop"></i>',
        ]);
        DB::table('counters')->insert([
            'title_ar' => 'طلب',
            'title_en' => 'Order',
            'count' => '2.4',
            'numerical_ar' => 'مليون',
            'numerical_en' => 'Million',
            'icon' => '<i class="icon-box"></i>',
        ]);
        DB::table('counters')->insert([
            'title_ar' => 'مبيعات المنصة',
            'title_en' => 'Platform Sales',
            'count' => '573',
            'numerical_ar' => 'مليون',
            'numerical_en' => 'Million',
            'icon' => '<i class="icon-wallet"></i>',
        ]);
    }
}
