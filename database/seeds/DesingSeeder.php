<?php

use Illuminate\Database\Seeder;

use App\Design;
class DesingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Design::create([
            'name' => 'Gimpo',
            'image' => 'stores_assets/site/design/gimpo.jpg',
        ]);

        Design::create([
            'name' => 'Rogan',
            'image' => 'stores_assets/site/design/rogan.jpg',
        ]);

        Design::create([
            'name' => 'Lums',
            'image' => 'stores_assets/site/design/lums.jpg',
        ]);
    }
}
