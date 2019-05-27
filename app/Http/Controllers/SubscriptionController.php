<?php

namespace App\Http\Controllers;

use App\Mail\ClientSubscribed;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SubscriptionController extends Controller
{
    public function store()
    {
        $attributes = request()->validate([
            'email' => 'required|email',
            'product_id' => 'required'
        ]);

        Mail::to($attributes['email'])->send(
            new ClientSubscribed(
                Product::findOrFail($attributes['product_id'])
            )
        );

        return back()->with('success', 'Thank you! Your e-mail has been sent');
    }
}
