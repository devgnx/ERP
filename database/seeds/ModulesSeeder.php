<?php

use Illuminate\Database\Seeder;

class ModulesSeeder extends Seeder
{
    private $slugs = [];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id    = '-a';
        $sku   = [];
        for ($i = 0; $i <= 10; $i++) {
            $sku[$i] = 'U' . $i . 'SK' . (($i + $i) * $i);
        }

        for ($i = 1; $i <= 50; $i++) {
            $code = str_random(5);

            if ($i > 45) {
                $name = 'Não póde~sêreal Lista!';
            } else {
                $name = str_random(6) . ' ' . str_random(7) . ' ' . str_random(3);
            }

            $slug = $this->getSlug($id, $code, $name);

            $id = DB::table('ModuleProduct')->insertGetId([
                'code'  => $code,
                'name'  => $name,
                'price' => rand(0, 100) . '.' . rand(0,99),
                'slug'  => $slug
            ]);

            DB::table('ModuleStock')->insert([
                'product_code' => $code,
                'sku' => $sku[substr($i, -1)],
                'quantity' => rand(0, 120)
            ]);
        }
    }

    private function checkSlug($slug, $use, $pass)
    {
        if (isset($this->slugs[$slug])) {
            $slug = $slug . '-' . Str::slug($use);
            return $this->checkSlug($slug, $pass, $use);
        } else {
            return $slug;
        }
    }

    private function getSlug($id, $code, $name)
    {
        $slug = $this->checkSlug( Str::slug($name), $code, $id );
        $this->slugs[$slug] = $slug;

        return $slug;
    }
}
