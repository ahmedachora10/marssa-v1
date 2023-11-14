<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionSeeder::class);
        $this->call(MangerSeeder::class);
        $this->call(CounterSeeder::class);
        $this->call(PlansSeeder::class);
        $this->call(ModelSeeder::class);
        $this->call(FeedbackSeeder::class);
        $this->call(FeaturesSeeder::class);
        $this->call(DesingSeeder::class);
    }
}
