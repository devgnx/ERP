<?php
namespace App\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;

class SalesRepository extends Repository
{
    /**
     * Specify Repository class name
     *
     * @return mixed
     */
    public function model()
    {
        return 'App\Models\Sales';
    }

    protected $products   = [];
    protected $sellers    = [];
    protected $sale_codes = [];

    public function __construct()
    {
        $this->sale = new stdObj();
    }


    protected function prepareSale($products)
    {
        foreach ($products as $key => $product_array) {
            $this->sale_codes[] = [
                'product_code' => $product['code'],
                'seller_code'  => $product['seller_code'];
            ];

            $product = (object) $product_array;
            $this->products[] = $product;
            $this->sellers[]  = $product->seller;
        }

        return $this;
    }
}