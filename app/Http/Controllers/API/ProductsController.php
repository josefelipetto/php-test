<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Product;
use App\Retailer;
use Illuminate\Support\Facades\Validator;

/**
 * Class ProductsController
 * @package App\Http\Controllers
 */
class ProductsController extends Controller
{


    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $products = Product::with('retailer')->get();

        return response()->json([
            'data' => $products
        ]);
    }


    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function store()
    {
        $rules = [
            'name' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'required',
            'description' => 'required|string',
            'retailer_id' => 'required|integer'
        ];

        $attributes = request()->all();

        $validator = Validator::make($attributes, $rules);

        if(!$validator->passes())
        {
            return response()->json([
                'data' => [],
                'errors' => $validator->errors()->all()
            ],400);
        }

        $attributes['image'] = $this->uploadImage($attributes['image']);

        $product = Product::create($attributes);

        return response()->json([
            'data' => $product
        ],201);
    }


    /**
     * @param $product_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($product_id)
    {
        $product = Product::find($product_id);

        if($product === null)
        {
            return response()->json([
                'data' => []
            ],404);
        }

        return response()->json([
            'data' => $product
        ]);
    }


    /**
     * @param $product_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($product_id)
    {

        $product = Product::find($product_id);

        if($product === null)
        {
            return response()->json([
                'data' => []
            ],404);
        }

        $rules = [
            'name' => 'string',
            'price' => 'numeric',
            'image' => '',
            'description' => 'string',
            'retailer_id' => 'integer'
        ];

        $attributes = request()->all();

        $validator = Validator::make($attributes, $rules);

        if(! $validator->passes() )
        {
            return response()->json([
                'data' => [],
                'errors' => $validator->errors()->all()
            ],400);
        }

        if(request()->has('image'))
        {
            $attributes['image'] = $this->uploadImage($attributes['image']);
        }

        $product->update($attributes);

        return response()->json([
            'data' => []
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
