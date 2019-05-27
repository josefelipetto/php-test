<?php

namespace App\Http\Controllers;

use App\Product;
use App\Retailer;
use Illuminate\Support\Facades\Storage;

/**
 * Class ProductsController
 * @package App\Http\Controllers
 */
class ProductsController extends Controller
{
    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store()
    {
        $attributes = request()->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'required|file',
            'description' => 'required|string',
            'retailer_id' => 'required|integer'
        ]);

        $attributes['image'] = $this->uploadImage($attributes['image']);

        Product::create($attributes);

        return redirect('/products')->with('success', 'Product created successfully!');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $products = Product::with('retailer')->paginate(15);
        return view('products.index',compact('products'));
    }


    /**
     * @param Product $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Product $product)
    {
        return view('products.show',compact('product'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {

        $retailers = $this->getRetailers();

        return view('products.create', compact('retailers'));
    }

    /**
     * @param Product $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Product $product)
    {
        $retailers = $this->getRetailers();

        $product->load('retailer');

        return view('products.edit', compact('retailers', 'product'));
    }

    /**
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
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

        if(request()->has('image'))
        {
            $attributes['image'] = $this->uploadImage($attributes['image']);
        }

        $product->update($attributes);

        return redirect('/products')->with('success', 'Product updated successfully');
    }

    /**
     * @return Retailer[]|\Illuminate\Database\Eloquent\Collection
     */
    private function getRetailers()
    {
        return Retailer::all([
            'id',
            'name'
        ]);
    }

    /**
     * @param $image
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    private function uploadImage($image)
    {
        /* @var \Illuminate\Http\UploadedFile $file */
        $file = $image;

        $filename = 'product_' . time() . '.' . $file->getClientOriginalExtension();

        return url('/storage/' . $file->storeAs('products', $filename));
    }
}
