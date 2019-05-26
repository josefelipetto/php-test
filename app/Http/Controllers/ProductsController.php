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
        $products = Product::all();

        return view('products.index',compact('products'));
    }
}