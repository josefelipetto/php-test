<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Retailer;
use Illuminate\Support\Facades\Validator;

class RetailersController extends Controller
{
    public function index()
    {
        $retailers = Retailer::all();

        return response()->json([
            'data' => $retailers
        ]);
    }


    public function store()
    {
        $rules = [
            'name' => 'required|string',
            'logo' => 'required|file',
            'description' => 'required|string',
            'website' => 'required|url'
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

        $attributes['logo'] = $this->uploadImage($attributes['logo']);

        $retailer = Retailer::create($attributes);

        return response()->json([
            'data' => $retailer
        ], 201);
    }

    public function show($retailer_id)
    {
        $retailer = Retailer::with('products')->find($retailer_id);

        if( $retailer === null )
        {
            return response()->json([
                'data' => []
            ],404);
        }

        return response()->json([
            'data' => $retailer
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

        $filename = 'retailer_' . time() . '.' . $file->getClientOriginalExtension();

        return url('/storage/' . $file->storeAs('retailers', $filename));
    }

    public function update($retailer_id)
    {

        $retailer = Retailer::find($retailer_id);

        if( $retailer === null )
        {
            return response()->json([
                'data' => []
            ],404);
        }

        $rules = [
            'name' => 'required|string',
            'logo' => 'file',
            'description' => 'string',
            'website' => 'url'
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

        if(request()->has('logo'))
        {
            $attributes['logo'] = $this->uploadImage($attributes['logo']);
        }

        $retailer->update($attributes);

        return response()->json([
            'data' => []
        ]);
    }



}
