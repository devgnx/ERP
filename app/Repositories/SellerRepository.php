<?php

namespace App\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;

class SellerRepository extends Repository
{
    /**
     * Specify Repository class name
     *
     * @return mixed
     */
    public function model()
    {
        return 'App\Models\Seller';
    }
}