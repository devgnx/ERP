<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleStatus;
use App\Models\SaleItem;
use App\Models\SaleShipping;

class ModulesSaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $weeks = ['add', 'sub'];

        $status_array = [
            ['name' => 'aberto',     'code' => 'o'],
            ['name' => 'enviado',    'code' => 's'],
            ['name' => 'finalizado', 'code' => 'c']
        ];

        foreach ($status_array as $status) {
            SaleStatus::create([
                'name' => $status['name'],
                'code' => $status['code']
            ]);
        }

        for ($i = 0; $i < 400; $i++) {
            $shipping_id = SaleShipping::create([
                'street' => $faker->streetName,
                'street_number'  => $faker->buildingNumber,
                'state_province' => $faker->state,
                'country'  => $faker->country,
                'postcode' => $faker->postcode,
                'price' => rand(5, 40) . ',' . rand(0, 99)
            ])->id;


            $sale_id = Sale::create([
                'seller_id'   => rand(1, 5),
                'customer_id' => rand(1, 10),
                'shipping_id' => $shipping_id,
                'status_id'   => rand(1, count($status_array)),
                'subtotal_price' => $faker->randomFloat(2, 0, 1000),
                'total_price' =>$faker->randomFloat(2, 0, 1000),
                'created_at'  => Carbon\Carbon::now()->{$weeks[ rand(0,1) ] . 'Days'}(rand(0, 20))
            ])->id;


            $count_items = rand(1, 4);

            for ($x = 0; $x < $count_items; $x++) {
                $product_id = rand(1, 50);
                $product = Product::find($product_id);
                SaleItem::create([
                    'product_id' => $product_id,
                    'sale_id' => $sale_id,
                    'quantity' => rand(1, 2),
                    'product_price' => $product->price
                ]);
            }
        }
    }
}
