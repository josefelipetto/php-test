<?php


namespace App\Services;


use App\Product;
use App\Repositories\ProductRepository;
use App\Repositories\ProductRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Http\UploadedFile;

class ProductService
{

    /**
     * @var ProductRepository
     */
    private $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getPaginatedProducts(): LengthAwarePaginator
    {
        return $this->productRepository->paginate(15);
    }

    public function store($data): Product
    {
        $data['image'] = $this->uploadImage($data['image']);
        return $this->productRepository->create($data);
    }

    public function update(Product $product, $data): bool
    {

        if(request()->has('image'))
        {
            $data['image'] = $this->uploadImage($data['image']);
        }

        return $product->update($data);
    }

    /**
     * @param UploadedFile $image
     * @return UrlGenerator|string
     */
    private function uploadImage($image)
    {
        $filename = 'product_' . time() . '.' . $image->getClientOriginalExtension();
        return url('/storage/' . $image->storeAs('products', $filename));
    }
}
