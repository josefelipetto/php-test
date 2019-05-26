<?php

namespace App\Http\Controllers;

use App\Retailer;

class RetailersController extends Controller
{
    public function index()
    {
        $retailers = Retailer::all();

        return view('retailers.index', compact('retailers'));
    }


    public function store()
    {
        $attibutes = request()->validate([
            'name' => 'required|string',
            'logo' => 'required|url',
            'description' => 'required|string',
            'website' => 'required|url'
        ]);

        Retailer::create($attibutes);

        return redirect('/retailers');
    }

    public function show(Retailer $retailer)
    {
        return view('retailers.show',compact('retailer'));
    }



}
