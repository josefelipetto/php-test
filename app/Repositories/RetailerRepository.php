<?php


namespace App\Repositories;


use App\Retailer;

class RetailerRepository implements RetailerRepositoryInterface
{
    public function all($fields = ['*'])
    {
        return Retailer::all($fields);
    }
}
