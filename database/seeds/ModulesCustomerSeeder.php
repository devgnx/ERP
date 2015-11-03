<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

use App\Models\Customer;
use App\Models\CustomerAddress;

class ModulesCustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $faker->addProvider(new \Faker\Provider\pt_BR\Person($faker));

        for ($i = 0; $i < 10; $i++) {
            $customer_id = Customer::create([
                'name'  => $faker->name,
                'email' => $faker->email,
                'phone' => $faker->phoneNumber
            ])->id;

            $count_address = rand(1, 4);

            for ($x = 0; $x < $count_address; $x++) {
                CustomerAddress::create([
                    'customer_id' => $customer_id,
                    'street' => $faker->streetName,
                    'street_number'  => $faker->buildingNumber,
                    'state_province' => $faker->state,
                    'country'  => $faker->country,
                    'postcode' => $faker->postcode
                ]);
            }
        }
    }
}
