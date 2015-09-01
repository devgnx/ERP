<?php

namespace App\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;

class SaleRepository extends Repository
{
    /**
     * Specify Repository class name
     *
     * @return mixed
     */
    public function model()
    {
        return 'App\Models\Sale';
    }
}