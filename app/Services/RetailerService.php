<?php


namespace App\Services;


use App\Repositories\RetailerRepository;
use App\Repositories\RetailerRepositoryInterface;

class RetailerService
{
    /**
     * @var RetailerRepository
     */
    private $retailerRepository;

    public function __construct(RetailerRepositoryInterface $retailerRepository)
    {
        $this->retailerRepository = $retailerRepository;
    }

    public function getAllRetailers($fields)
    {
        return $this->retailerRepository->all($fields);
    }
}
