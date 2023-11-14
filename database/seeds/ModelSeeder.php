<?php

use Illuminate\Database\Seeder;

class ModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            DB::table('models')->insert([
                'title_ar' => 'هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة',
                'title_en' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
                'description_ar' => 'هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.',
                'description_en' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s',
                'screenshot' => 'stores_assets/site/models/model_1_screenshot.png',
                'icon' => 'stores_assets/site/models/model_1_icon.png',
                'link' => env('APP_URL'),
            ]);
        }
    }
}
