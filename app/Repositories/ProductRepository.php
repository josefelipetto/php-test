<?php


namespace App\Repositories;


use App\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProductRepository implements ProductRepositoryInterface
{
    public function paginate(int $perPage): LengthAwarePaginator
    {
        return Product::with('retailer')->paginate($perPage);
    }

    public function findById(int $id) : ?Product
    {
        return Product::find($id);
    }

    public function create($attributes) : Product
    {
        return Product::create($attributes);
    }
}
