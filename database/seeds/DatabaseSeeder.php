<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Eloquent::unguard();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $this->call(UserSeeder::class);
        $this->call(ModulesProductStockCategorySeeder::class);
        $this->call(ModuleSellerSeeder::class);
        $this->call(ModulesSaleSeeder::class);
        $this->call(ModuleStoreSeeder::class);
        $this->call(ModulesCustomerSeeder::class);
        $this->call(NotifynderSeeder::class);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        \Eloquent::reguard();
    }
}
