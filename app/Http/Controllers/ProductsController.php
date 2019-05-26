<?php

namespace App\Http\Controllers;

use App\Product;

class ProductsController extends Controller
{
    public function store()
    {
        $attributes = request()->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'required|url',
            'description' => 'required|string',
            'retailer_id' => 'required|integer'
        ]);


        Product::create($attributes);

        return redirect('/products');
    }

    public function index()
    {
        $products = Product::with('retailer')->paginate(15);
        return view('products.index',compact('products'));
    }


    public function show(Product $product)
    {
        return view('products.show',compact('product'));
    }
}
