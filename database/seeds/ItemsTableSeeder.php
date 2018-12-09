<?php

use Illuminate\Database\Seeder;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 20 ; $i++){
            $item = new \App\Item();
            $item->price = rand(50, 10000);
            $item->name = $faker->words(3, true);
            $item->isActive = true;
            $item->save();
        }
    }
}
