
application/x-httpd-php MangerSeeder.php ( C++ source, UTF-8 Unicode text )
<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use App\User;
use App\Store;
use App\Information;

class MangerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $information = Information::create([
            'logo' => 'stores_assets/site/logo.png',
            'icon' => 'stores_assets/site/logo_browser.png',
            'preview' => 'stores_assets/site/preview.png',
            'title_page_ar' => 'المرصة',
            'description_ar' => 'امتلك متجر احترافي بأقل التكاليف وبدون عمولة على المبيعات',
            'title_page_en' => 'lmersa',
            'description_en' => 'All the tools you need to build a successful store',
            'keyword_ar' => 'المرصة، متجر، الكتروني',
            'keyword_en' => 'lmersa, tools, store',
            'address' => 'gaza',
            'phone' => '000000000',
            'email' => 'test@email.com',
            'facebook' => 'facebook.com',
            'twitter' => 'twitter.com',
            'whatsapp' => '000000000',
            'instagram' => 'instagram.com',
            'youtube' => 'youtube.com',
        ]);

        $store = new Store();
        $store['name'] = 'site';
        $store['domain'] = 'site';
        $store['status'] = true;
        $store['language'] = 2;
        $store->information()->associate($information);
        $store->save();

        $manger = new User();

        $manger['name'] = 'Mohamed Lemine';
        $manger['username'] = 'medlemine';
        $manger['email'] = env('MasterEmail');
        $manger['password'] = bcrypt('medlemine');
        $manger['permission'] = 1;
        $manger['status'] = 1;
        $manger['email_verified_at'] = now();
        $manger->store()->associate($store);
        $manger->save();
        $manger->givePermissionTo(Permission::all());
        $manger->assignRole('SuperAdmin');
    }
}