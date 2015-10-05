<?php

use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

use App\Models\Product;
use App\Models\Supplier;
use App\Models\ProductStock as Stock;
use App\Models\ProductCategory as Category;

class ModulesProductStockCategorySeeder extends Seeder
{
    private $slugs = [];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();
        Product::truncate();
        Stock::truncate();

        $faker = Faker::create();
        $faker->addProvider(new \Faker\Provider\pt_BR\Person($faker));
        $faker->addProvider(new \Faker\Provider\pt_BR\Company($faker));
        $faker->addProvider(new \Faker\Provider\pt_BR\PhoneNumber($faker));
        $faker->addProvider(new \Faker\Provider\Lorem($faker));

        $category_length = 15;
        for ($i = 1; $i <= $category_length; $i++) {
            $parent_id = (rand(0, 4) == 4) ? null : rand(1, 25);

            Category::create([
                'parent_id' => $parent_id,
                'name' => ((boolean) rand(0, 1)) ? $faker->sentence(2) : str_random(6)
            ]);
        }

        $supplier_length = 30;
        for ($i = 1; $i <= $supplier_length; $i++) {
            Supplier::create([
                'name'   => $faker->name,
                'cnpj'   => $faker->cnpj,
                'email'  => $faker->email,
                'phone'  => $faker->phoneNumber,
                'street' => $faker->streetName,
                'street_number'  => $faker->buildingNumber,
                'state_province' => $faker->state,
                'country'  => $faker->country,
                'zip_code' => $faker->postcode,
                'slug' => $faker->slug
            ]);
        }

        for ($i = 1; $i <= 50; $i++) {
            $product_id = Product::create([
                'code'  => str_random(5),
                'name'  => $faker->name,
                'price' => $faker->randomFloat(2, 0, 100),
                'slug'  => $faker->slug
            ])->id;

            Stock::create([
                'product_id' => $product_id,
                'sku' => str_random(5),
                'quantity' => rand(0, 120)
            ]);


            ///////////////////////////////////////////////////////


            $category_id = rand(1, $category_length);

            // Inserts random product with random category if not exists
            DB::table('module_product_in_category')
                ->where('product_id', '<>', $product_id)
                ->where('category_id', '<>', $category_id)
                ->insert([
                    'product_id' => $product_id,
                    'category_id' => $category_id
                ]);

            // Inserts random product with first category for tests
            DB::table('module_product_in_category')->insert([
                'product_id' => $product_id,
                'category_id' => 1
            ]);


            //////////////////////////////////////////////////////////


            $supplier_id = rand(1, $supplier_length);

            // Inserts random product with random supplier if not exists
            DB::table('module_product_in_supplier')
                ->where('product_id', '<>', $product_id)
                ->where('supplier_id', '<>', $supplier_id)
                ->insert([
                    'product_id' => $product_id,
                    'supplier_id' => $supplier_id
                ]);

            // Inserts random product with first supplier for tests
            DB::table('module_product_in_supplier')->insert([
                'product_id' => $product_id,
                'supplier_id' => 1
            ]);
        }
    }
}
