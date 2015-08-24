<?php

use Illuminate\Database\Seeder;

class ModulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 50; $i++) {
            $code = str_random(5);

            DB::table('ModuleProduct')->insert([
                'code' => $code,
                'name' => str_random(10),
                'price' => rand(0, 100) . ',' . rand(0,99)
            ]);

            DB::table('ModuleStock')->insert([
                'product_code' => $code,
                'quantity' => rand(0, 120)
            ]);
        }
    }
}
