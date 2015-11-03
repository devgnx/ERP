<?php

use Illuminate\Database\Seeder;
use Fenos\Notifynder\Models\NotificationCategory;

class NotifynderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $this->createCategory('sale.new', 'Nova venda efetuada #{extra.sale}');
        $this->createCategory('product.new', 'Novo produto criado {extra.product}');
    }

    public function createCategory($name, $text) {
        NotificationCategory::create([
            'name' => $name,
            'text' => $text
        ]);
    }
}
