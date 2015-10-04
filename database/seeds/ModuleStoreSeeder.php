<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

use App\Models\Store;

class ModuleStoreSeeder extends Seeder
{
    private $slugs = [];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        Store::truncate();
        Store::create([
            'name'  => $faker->company,
            'title' => $faker->company
        ])->id;
    }
}
