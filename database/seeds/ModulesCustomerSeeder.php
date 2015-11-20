<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

use App\Models\Customer;
use App\Models\CustomerPerson;
use App\Models\CustomerCompany;
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
        $faker->addProvider(new \Faker\Provider\pt_BR\Company($faker));
        $faker->addProvider(new \Faker\Provider\pt_BR\Address($faker));
        $faker->addProvider(new \Faker\Provider\pt_BR\PhoneNumber($faker));
        $faker->addProvider(new \Faker\Provider\Internet($faker));

        $gender = ['male', 'female'];
        $person_company = [
            ['type' => 'person', 'email' => 'email'],
            ['type' => 'company', 'email' => 'companyEmail']
        ];
        $cpf_cnpj = ['cpf', 'cnpj'];
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
            $faker_customer = $person_company[rand(0, 1)];
            $customer_id = Customer::create([
                'email' => $faker->{$faker_customer['email']},
                'phone' => $faker->phoneNumber,
                'is'    => $faker_customer['type'],
                'type_id'  => rand(1, $types_length)
            ])->id;

            if ($faker_customer['type'] == 'person') {
                CustomerPerson::create([
                    'name' => $faker->name,
                    'cpf'  => $faker->cpf,
                    'customer_id' => $customer_id
                ]);
            } else {
                CustomerCompany::create([
                    'name' => $faker->company,
                    'trading_name' => $faker->company . $faker->name,
                    'cnpj' => $faker->cnpj,
                    'customer_id' => $customer_id
                ]);
            }

            $count_address = rand(1, 4);

            for ($x = 0; $x < $count_address; $x++) {
                CustomerAddress::create([
                    'customer_id' => $customer_id,
                    'street' => $faker->streetName,
                    'street_number'  => $faker->buildingNumber,
                    'city' => $faker->city,
                    'state_province' => $faker->stateAbbr,
                    'country'  => $faker->country,
                    'postcode' => $faker->postcode,
                    'main' => $x == 0 ? 1 : null
                ]);
            }
        }
    }
}
