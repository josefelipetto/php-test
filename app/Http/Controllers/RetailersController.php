<?php

namespace App\Http\Controllers;

use App\Retailer;

class RetailersController extends Controller
{
    public function index()
    {
        $retailers = Retailer::paginate(15);

        return view('retailers.index', compact('retailers'));
    }


    public function store()
    {
        $attributes = request()->validate([
            'name' => 'required|string',
            'logo' => 'required|file',
            'description' => 'required|string',
            'website' => 'required|url'
        ]);

        $attributes['logo'] = $this->uploadImage($attributes['logo']);

        Retailer::create($attributes);

        return redirect('/retailers')->with('success', 'Retailer successfully created');
    }

    public function show(Retailer $retailer)
    {
        $retailer->load('products');

        return view('retailers.show',compact('retailer'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('retailers.create');
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

    public function edit(Retailer $retailer)
    {
        return view('retailers.edit', compact('retailer'));
    }

    public function update(Retailer $retailer)
    {

        $attributes = request()->validate([
            'name' => 'required|string',
            'logo' => 'file',
            'description' => 'required|string',
            'website' => 'required|url'
        ]);

        if(request()->has('logo'))
        {
            $attributes['logo'] = $this->uploadImage($attributes['logo']);
        }

        $retailer->update($attributes);

        return redirect('/retailers')->with('success', 'Retailer updated successfully');
    }



}
