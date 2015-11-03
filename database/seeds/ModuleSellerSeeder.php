<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;
use App\Models\Seller;

class ModuleSellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Seller::truncate();

        $faker = Faker::create();
        $faker->addProvider(new \Faker\Provider\pt_BR\Person($faker));

        for ($i = 1; $i <= 5; $i++) {
            $seller_id = Seller::create([
                'code'  => str_random(5),
                'name'  => $faker->name,
                'slug'  => $faker->slug
            ])->id;

        }

        DB::table('module_seller')->where('id', 1)->update(['user_id' => 1]);
    }
}
