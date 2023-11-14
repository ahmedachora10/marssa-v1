<?php

use Illuminate\Database\Seeder;

class FeaturesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('features')->insert([
            'title_ar' => 'امتلك متجر بهويتك الخاصة وبأقل التكاليف',
            'title_en' => 'Own a store with your own ID at the lowest costs',
            'description_ar' => 'معنا تستطيع خلال دقائق إنشاء متجرك الخاص بأقل التكاليف والحصول على استضافة مجانية وتحديثات مستمرة ومتجددة وبدون أي عمولة على المبيعات',
            'description_en' => 'With us you can within minutes create your own store at the lowest costs and get free hosting and constant updates and renewed without any commission on sales',
            'icon' => '<i class="icon-online-shop2"></i>',
        ]);

        DB::table('features')->insert([
            'title_ar' => 'سهولة إدراج المنتجات وإدارة المخزون',
            'title_en' => 'Ease of product listing and inventory management',
            'description_ar' => 'ستتمكن من إدارة منتجاتك، مهما كان نوع هذه المنتجات سواءاً منتجات جاهزة أو حسب الطلب أو منتجات رقمية وغيرها بكل سهولة',
            'description_en' => 'You will be able to manage your products, regardless of the type of these products, whether ready or customized, digital or other products with ease',
            'icon' => '<i class="icon-online-shop3"></i>',
        ]);
        DB::table('features')->insert([
            'title_ar' => 'أدوات تسويقية لزيادة مبيعاتك',
            'title_en' => 'Marketing tools to increase your sales',
            'description_ar' => 'حرصنا من تمكين التجار من التسويق بشكل قوي وبأدوات سهلة وبسيطة. حيث يمكنك عمل حملات تسويقية وإرسالها للعملاء مع تحديد الشريحة المستهدفة بإحترافية وسهولة',
            'description_en' => 'We made sure to enable merchants to market powerfully with simple and easy tools. You can create marketing campaigns and send them to the customers, specifying the target segment professionally and easily',
            'icon' => '<i class="icon-laptop"></i>',
        ]);
        DB::table('features')->insert([
            'title_ar' => 'تقارير مفصلة لقياس أداء المتجر',
            'title_en' => 'Detailed reports to measure the performance of the store',
            'description_ar' => 'Through reports you will be able to get all the information you need to know the store\'s performance and make the best decisions',
            'description_en' => 'من خلال التقارير ستتمكن من الحصول على جميع المعلومات التي تحتاج إليها لمعرفة أداء المتجر وإتخاذ أفضل القرارات',
            'icon' => '<i class="icon-clipboard"></i>',
        ]);
        DB::table('features')->insert([
            'title_ar' => 'امتلك متجر بهويتك الخاصة وبأقل التكاليف',
            'title_en' => 'Own a store with your own ID at the lowest costs',
            'description_ar' => 'معنا تستطيع خلال دقائق إنشاء متجرك الخاص بأقل التكاليف والحصول على استضافة مجانية وتحديثات مستمرة ومتجددة وبدون أي عمولة على المبيعات',
            'description_en' => 'With us you can within minutes create your own store at the lowest costs and get free hosting and constant updates and renewed without any commission on sales',
            'icon' => '<i class="icon-online-shop2"></i>',
        ]);

        DB::table('features')->insert([
            'title_ar' => 'سهولة إدراج المنتجات وإدارة المخزون',
            'title_en' => 'Ease of product listing and inventory management',
            'description_ar' => 'ستتمكن من إدارة منتجاتك، مهما كان نوع هذه المنتجات سواءاً منتجات جاهزة أو حسب الطلب أو منتجات رقمية وغيرها بكل سهولة',
            'description_en' => 'You will be able to manage your products, regardless of the type of these products, whether ready or customized, digital or other products with ease',
            'icon' => '<i class="icon-online-shop3"></i>',
        ]);
    }
}
