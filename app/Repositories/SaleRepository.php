<?php

namespace App\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;
use Illuminate\Support\Collection;
use Illuminate\Container\Container as App;

class SaleRepository extends Repository
{
    /**
     * Specify Repository class name
     *
     * @return mixed
     */
    public function model()
    {
        return 'App\Models\SaleOrder';
    }

    public function getTable()
    {
        return \App::make( $this->model() )->getTable();
    }

    public function getNewSales()
    {
        if ($user = \Sentinel::getUser()) {
            dd($user->getNotificationsNotRead());

            $notifications = $user->getNotificationsNotRead();
            $this->new = [1];

        } else {
            $this->new = [];
        }
    }

    public function all($columns = array('*'))
    {
        $collection = parent::all($columns);
        $collection->new = $this->getNewSales();

        return $collection;
    }

}