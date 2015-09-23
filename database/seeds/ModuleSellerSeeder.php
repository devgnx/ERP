<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

use App\Models\Seller as Seller;

class ModuleSellerSeeder extends Seeder
{
    private $slugs = [];

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

            /*$user_id = rand(1, 25);

            // Inserts random seller with random category if not exists
            DB::table('module_user_seller_pivot')
                ->where('seller_id', '<>', $seller_id)
                ->where('user_id', '<>', $user_id)
                ->insert([
                    'seller_id' => $seller_id,
                    'user_id' => $user_id
                ]);

            // Inserts random seller with first category for tests
            DB::table('module_seller_category_pivot')->insert([
                'seller_id' => $seller_id,
                'user_id' => 1
            ]);*/
        }
    }
}
