<?php

use Illuminate\Database\Seeder;
use App\Plan;

class PlansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('plans')->insert([
            'name_en' => 'basic',
            'name_ar' => 'بيسك',
            'description_ar' => 'عدد لا محدود من المنتجات * عدد لا محدود من الطلبات * عدد لا محدود من العملاء * عدد لا محدود من كوبونات التخفيض * استقبال اسئلة وتقييمات العملاء',
            'description_en' => 'Unlimited number of products * Unlimited number of orders * Unlimited number of customers * Unlimited number of discount coupons * Receiving questions and customer reviews',
            'price' => 29.9,
            'language' => false,
            'ssl' => true,
            'integration' => false,
            'custom_domain' => false,
            'custom_design' => false,
            'offer_count' => 10,
            'order_count' => 100,
            'users_count' => 3,
        ]);
        DB::table('plans')->insert([
            'name_en' => 'Plus',
            'name_ar' => 'بلس',
            'description_ar' => 'جميع مميزات سلة بيسك * أدوات تسويقية * دعم جميع أنواع المنتجات * تقارير متقدمة * التحكم بتصميم المتجر',
            'description_en' => 'All features of the Plan Basic * Marketing tools * Support of all types of products * Advanced reports * Control the design of the store',
            'price' => 59.9,
            'language' => true,
            'ssl' => true,
            'integration' => true,
            'custom_domain' => false,
            'custom_design' => true,
            'offer_count' => 1000,
            'order_count' => 10000,
            'users_count' => 300,
        ]);
        DB::table('plans')->insert([
            'name_en' => 'Pro',
            'name_ar' => 'برو',
            'description_ar' => 'جميع مميزات سلة بلس * إضافة فريق عمل * تعيين صلاحيات محددة للمستخدمين * الربط مع الخدمات الاعلانية * دعم ضريبة القيمة المضافة',
            'description_en' => 'All of Plan Plus features * Adding a team * Assigning specific powers to users * Connecting with advertising services * Supporting VAT',
            'price' => 99.9,
            'language' => true,
            'ssl' => true,
            'integration' => true,
            'custom_domain' => true,
            'custom_design' => true,
            'offer_count' => 1000000,
            'order_count' => 1000000,
            'users_count' => 1000000,
        ]);
    }
}
