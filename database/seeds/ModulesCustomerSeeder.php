<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

use App\Models\Customer;
use App\Models\CustomerTypeGroup;
use App\Models\CustomerType;
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

        $gender = ['male', 'female'];
        $types_length = 13;
        $types_group_lenght = 4;

        for ($i = 0; $i < $types_group_lenght; $i++)
        {
            CustomerTypeGroup::create([
                'name' => $faker->firstName($gender[rand(0,1)])
            ]);
        }

        for ($i = 0; $i < $types_length; $i++) {
            CustomerType::create([
                'name' => $faker->firstName($gender[rand(0,1)]),
                'group_id' => rand(1, $types_group_lenght)
            ]);
        }

        for ($i = 0; $i < 30; $i++) {
            $customer_id = Customer::create([
                'name'  => $faker->name,
                'email' => $faker->email,
                'phone' => $faker->phoneNumber,
                'type_id' => rand(1, $types_length)
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
