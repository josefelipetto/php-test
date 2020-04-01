<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProduct;
use App\Product;
use App\Services\ProductService;
use App\Services\RetailerService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

/**
 * Class ProductsController
 * @package App\Http\Controllers
 */
class ProductsController extends Controller
{


    /**
     * @var ProductService
     */
    private $productService;
    /**
     * @var RetailerService
     */
    private $retailerService;

    public function __construct(ProductService $productService, RetailerService $retailerService)
    {
        $this->productService = $productService;
        $this->retailerService = $retailerService;
    }

    /**
     * @return Factory|View
     */
    public function index()
    {
        $products = $this->productService->getPaginatedProducts();
        return view('products.index',compact('products'));
    }

    /**
     * @param Product $product
     * @return Factory|View
     */
    public function show(Product $product)
    {
        return view('products.show',compact('product'));
    }

    /**
     * @param StoreProduct $request
     * @return RedirectResponse|Redirector
     */
    public function store(StoreProduct $request)
    {
        $attributes = $request->validated();

        $this->productService->store($attributes);

        return redirect('/products')->with('success', 'Product created successfully!');
    }

    /**
     * @return Factory|View
     */
    public function create()
    {
        $retailers = $this->retailerService->getAllRetailers(['id', 'name']);
        return view('products.create', compact('retailers'));
    }

    /**
     * @param Product $product
     * @return Factory|View
     */
    public function edit(Product $product)
    {
        $retailers = $this->retailerService->getAllRetailers(['id', 'name']);

        $product->load('retailer');
        return view('products.edit', compact('retailers', 'product'));
    }

    /**
     * @param Product $product
     * @return RedirectResponse|Redirector
     */
    public function update(Product $product)
    {
        $attributes = request()->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'file',
            'description' => 'required|string',
            'retailer_id' => 'required|integer'
        ]);

        $this->productService->update($product, $attributes);

        return redirect('/products')->with('success', 'Product updated successfully');
    }
}
